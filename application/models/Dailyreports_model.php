<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dailyreports_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function dailyCollectionReport($rec){
		$fdate = $rec['fdate'];
		$tdate = $rec['tdate'];
		if(isset($rec['ctg']) && !empty($rec['ctg'])){
			$ctg = 	$rec['ctg'];
			$query=$this->db->query("select fund.voucherno, fund.sub_title, fund.cr,  fund.payment_date, g.bno, t.bcomname, m.trackid ,m.status from fund_sub_ctg fund left join getlicense g on fund.voucherno=g.vno left join tradelicense t on t.trackid = g.trackid left join money m on m.inno = fund.voucherno where  date(fund.payment_date) between '$fdate' AND '$tdate' AND sub_title='$ctg' order by fund.voucherno asc");
			$retunData=$query->result();
			foreach( $retunData as $key=>$value){
				if($value->status== 2 || $value->status==3){
					$retunData[$key]->showData=$this->daily_collection_com_info($value->voucherno);
				}else if($value->status == 4){
					$retunData[$key]->holding_info = $this->holding_client_info($value->trackid);
				}else{
					continue;
				}
			}
		}
		else{
			$query=$this->db->query("select fund.voucherno, fund.sub_title, fund.cr,  fund.payment_date, g.bno, t.bcomname, m.trackid, m.status from fund_sub_ctg fund left join getlicense g on fund.voucherno=g.vno left join tradelicense t on t.trackid = g.trackid left join money m on m.inno = fund.voucherno where  date(fund.payment_date) between '$fdate' AND '$tdate' order by fund.voucherno asc");
			$retunData=$query->result();
			
			foreach( $retunData as $key=>$value){
				if($value->status== 2 || $value->status==3){
					$retunData[$key]->showData=$this->daily_collection_com_info($value->voucherno);
				}else if($value->status == 4){
					$retunData[$key]->holding_info = $this->holding_client_info($value->trackid);
				}else{
					continue;
				}
			}
		}
		return $retunData;
	}
	public function daily_collection_com_info($vno){
	
		$qy=$this->db->query("select m.status, t.bcomname, g.bno from money m left join tradelicense t on t.sno = m.trackid left join getlicense g on g.trackid = t.trackid where m.inno='$vno' order by g.id desc LIMIT 1")->row();
	
		return '&nbsp;&raquo;&nbsp;'.$qy->bcomname.'&nbsp;&raquo;SN#'.$qy->bno;
	}
	public function holding_client_info($dagno){
		$q = $this->db->query("select name, dag_no from holdingclientinfo where dag_no='$dagno' group by dag_no limit 1")->row();
		return '&nbsp;&raquo;&nbsp;'.$q->name.'&nbsp;&raquo;DN#'.$q->dag_no;
	}
	/* 
	*	Daily vat collection report 
	*/
	
	public function daily_vat_collection_report($request){
		$where = [
			'status'	=> 1,
			'date(payment_date) >=' => $request['fdate'],
			'date(payment_date) <=' => $request['tdate']
		];
		
		$query = $this->db->select("id,inno,trackid,fee,vat,total,payment_date,status")
							->where($where)
							->order_by('inno',"ASC")
							->get('money');
		$return_data = $query->result();
		
		foreach($return_data as $key => $value){
			$return_data[$key]->sub_title = $this->sub_title_info($value->inno);
		}
		return $return_data;
	}
	
	public function sub_title_info($vno = false){
		
		if(isset($vno) && !empty($vno)){
			
			$query = $this->db->select("g.bno,t.bcomname")
								->join('tradelicense as t','g.trackid=t.trackid','left')
								->where(['g.vno' => $vno])
								->limit(1)
								->get('getlicense as g');
			
			if($query->num_rows() > 0){
				$qy = $query->row();
				return 'ট্রেড লাইসেন্স ফি&nbsp;&raquo;&nbsp;'.$qy->bcomname.'&nbsp;&raquo;SN#'.$qy->bno;
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
	public function get_holding_tax_unrealized_report($receive){
		$where = ($receive['year'] === null ? 'year.is_current = 1' : "md5(log.fisyal_year_id)= '$receive[year]'");
		
		$query = $this->db->select('info.name, info.holding_no, info.dag_no, rate.amount,  CONCAT(label.rate_sheet_label,"-",occupation.title,"-", classification.title) as rate_sheet_label', false)
				->join('holding_rate_sheet as rate', 'rate.id = info.rate_sheet_id')
				->join('holding_rate_sheet_label as label', 'label.id = rate.label_id')
				->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->where(['info.is_active' => 1])
				->where("info.dag_no NOT IN(SELECT log.dag_no FROM payment_log_bosotbita as log join tbl_fiscal_year as year on year.id=log.fisyal_year_id WHERE $where)")
			 	->order_by('info.id', 'DESC')
				->get('holdingclientinfo as info');
				
		return array_column($query->result(), 'amount');
		
		if($query->num_rows() > 0){
			return [
				'status' => 'success',
				'message' => 'Information found',
				'total_amount' => array_sum(array_column($query->result(), 'amount')),
				'data'=> $query->result()
			];
		}else{
			return ['status' => 'error', 'message' => 'Information not found', 'total_amount' => 0.00, 'data'=>[]];
		}
	}
	public function get_yearly_holding_tax_report($receive){
		$where = ($receive['year']===null ? ['year.is_current' => 1] : ['md5(log.fisyal_year_id)' => $receive['year']]);
		
		$query = $this->db->select('year.full_year as fiscal_year, info.name, info.holding_no, log.dag_no, log.invoice, log.sub_amount as amount, DATE_FORMAT(log.payment_date,"%Y-%m-%d") as payment_date, log.book_number, log.money_receipt, CONCAT(label.rate_sheet_label,"-",occupation.title,"-", classification.title) as rate_sheet_label', false)
				->join('tbl_fiscal_year as year', 'year.id=log.fisyal_year_id')
				->join('holdingclientinfo as info', 'info.dag_no=log.dag_no')
				->join('holding_rate_sheet as rate', 'rate.id = log.rate_sheet_id')
				->join('holding_rate_sheet_label as label', 'label.id = rate.label_id')
				->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->where($where)
			 	->order_by('year.id', 'DESC')
				->order_by('log.id', 'DESC')
				->get('payment_log_bosotbita as log');	
				
		if($query->num_rows() > 0){
			return [
				'status' => 'success',
				'message' => 'Information found',
				'total_amount' => array_sum(array_column($query->result(), 'amount')),
				'data'=> $query->result()
			];
		}else{
			return ['status' => 'error', 'message' => 'Information not found', 'total_amount' => 0.00, 'data'=>[]];
		}
	}
	// daily holding tax 
	public function get_daily_holding_tax_report($receive){
		$query = $this->db->select('year.full_year as fiscal_year, info.name, info.holding_no, log.dag_no, log.invoice, log.sub_amount as amount, DATE_FORMAT(log.payment_date,"%Y-%m-%d") as payment_date, log.book_number, log.money_receipt, CONCAT(label.rate_sheet_label,"-",occupation.title,"-", classification.title) as rate_sheet_label', false)
				->join('tbl_fiscal_year as year', 'year.id=log.fisyal_year_id')
				->join('holdingclientinfo as info', 'info.dag_no=log.dag_no')
				->join('holding_rate_sheet as rate', 'rate.id = log.rate_sheet_id')
				->join('holding_rate_sheet_label as label', 'label.id = rate.label_id')
				->join('snf_global_form as occupation','occupation.id=rate.occupation_id')
				->join('snf_global_form as classification', 'classification.id=rate.classification_id')
				->where(['date(log.payment_date)' => $receive['cDate']])
				->order_by('year.id', 'DESC')
				->order_by('log.id', 'DESC')
				->get('payment_log_bosotbita as log');
					
		if($query->num_rows() > 0){
			return [
				'status' => 'success',
				'message' => 'Information found',
				'total_amount' => array_sum(array_column($query->result(), 'amount')),
				'data'=> $query->result()
			];
		}else{
			return ['status' => 'error', 'message' => 'Information not found', 'total_amount' => 0.00, 'data'=>[]];
		}
	}
}