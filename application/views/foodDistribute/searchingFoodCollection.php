<table id="exampleNew" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="3%">S/L</th>
        <th>Name</th>
        <th >NID</th>
        <th >Mobile</th>
        <th >Received Food</th>
        <th >Dealer Name</th>
        <th >Dealer Mobile</th>
        <th >Receive Date</th>
        <th width="15%">#</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    if(!empty($record)){
        foreach ($record as $row){
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row->name ?></td>
                <td><?php echo $row->nid ?></td>
                <td><?php echo $row->applicant_mobile ?></td>
                <td><?php echo $row->food_amount; echo (!empty($row->unit_id) && ($row->unit_id==1)?' Kg':'') ?></td>
                <td><?php echo $row->dealer_name ?></td>
                <td><?php echo $row->dealer_mobile ?></td>
                <td><?php echo (!empty($row->receive_dt)?date('d M, Y',strtotime($row->receive_dt)):'') ?></td>
                <td>
                    <button type="button" data-toggle="modal"  data-target="#exampleModal" onclick="editFoodCollectionInfo('<?php echo $row->id  ?>')" name="update" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit </button>
                    <button type="button" name="delete" title="Delete" onclick="DeleteFoodCollectionInfo('<?php echo $row->id  ?>')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</button>
                </td>
            </tr>
            <?php
        }
    }else{
        echo "<tr><td colspan='9'> No Data Found</td></tr>";
    }
    ?>
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        $('#exampleNew').DataTable();
    } );
</script>