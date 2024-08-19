<?php 
include_once('includes/header.php');
// select notices
$query = "SELECT * FROM `notices`;";
$result = mysqli_query($con, $query);
?>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">notices</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="<?php echo BASE_URL.'notice';?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Add New
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered tblcls">
                                    <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                $count = 1;
                                                while($data = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td width="5%"><?php echo $count;?></td>
                                                <td width="15%"><?php echo $data['title'];?></td>
                                                <td width="30%">
                                                    <span><?php echo substr(($data['content']),0,150);?></span>
                                                    <span data-toggle="modal" data-target="#openModal_<?=$count;?>" style="color: #0520f7;">Read More...</span>
                                                </td>
                                                <td width="10%"><?php echo date('d/m/Y',strtotime($data['notice_date']));?></td>
                                                <?php if($data['status'] == 'Y'){?>
                                                    <td width="10%"><span class="badge bg-success">Active</span></td>
                                                <?php } else {?>
                                                    <td width="10%"><span class="badge bg-warning">Inactive</span></td>
                                                <?php }?>
                                                <td width="10%">
                                                    <a href="<?php echo BASE_URL.'notice?type=edit&uid='.$data['id'];?>"><svg width="1.5em" height="1.5em" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/>
                                                    </svg></a>
                                                    
                                                    <a href="<?php echo BASE_URL.'notice?type=delete&uid='.$data['id'];?>">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z" fill="#0D0D0D"/>
                                                    </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!--modal-->
                                            <div id="openModal_<?=$count;?>" class="modal animated" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content" style="width: 60rem; margin-left: -235px;">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">Content</h6>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" style="color:#fff;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-sm-12 col-12 input-fields">
                                                                <p><?php echo $data['content'];?></p>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            $count++;
                                            }
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    $('#data-table').dataTable();
});
</script>
<?php include_once('includes/footer.php');?>