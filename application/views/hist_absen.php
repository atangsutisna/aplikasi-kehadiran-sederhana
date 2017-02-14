   <link rel="stylesheet" href="<?php echo base_url();?>css/themes/jquery.ui.all.css" type="text/css" />

	<script type="text/javascript">
	$(document).ready(function() { 
	  $(function() {
		applyPagination();
		function applyPagination() {
		  $(".pages a").click(function() {
		   var url = $(this).attr("href");
		   $.ajax({
			  type: "POST",
			  data: "",
			  url: url,
			  beforeSend: function() {
				$(".well-content").html("<div class='loading_div'><img src='<?php echo base_url() ?>img/loading.gif'></div>");
			  },
			  success: function(msg) {
				$("#tabledata").html(msg);
				<!-- applyPagination(); -->
			  }
			});
			 return false;
			});
		}
	  }); 
	});
	 function detailData(id){
		 $("#tr"+id).toggle();
		 $.ajax({
			url:'<?php echo base_url(); ?>cuti/detail/'+id,		 
			type:'POST',
			data:$('#frmsave').serialize(),
			success:function(data){ 
				$("#detail"+id).html('');  
				$("#detail"+id).append(data);  
			}  
		});		
	 }
	 function getdata(){
	 	  $.ajax({
			  type: "POST",
			  data: "",
			  url:'<?php echo base_url(); ?>cuti/search/',	
			  beforeSend: function() {
				$(".well-content").html("<div class='loading_div'><img src='<?php echo base_url() ?>img/loading.gif'></div>");
			  },
			  success: function(msg) {
				$("#tabledata").html(msg);
			  }
			});
	 }
 	 function simpan(id){
	 	$.ajax({
			url:'<?php echo base_url(); ?>cuti/approval/'+id,		 
			type:'POST',
			data:$('#aksiform').serialize(),
			success:function(data){ 
				$( "#infodlg" ).html(data);
				$( "#infodlg" ).dialog({ title:"Info...", draggable: false});	
				getdata();
			}  
		});		
	 }
	 function actCuti(id){
	 $("#idcuti").val(id);
					$("#actCutiPegawai").dialog({
					 resizable: false,
					 modal: true,
					 title:"Approval Cuti",
					 draggable: false,
					 width: 'auto',					 
					 height: 'auto',
					 buttons: {
					 "Ya": function(){
						 simpan(id);   
						  $(this).dialog("close");
					  },
					  "Tutup": function(){
						   $(this).dialog("close");
						}
					 }
				  });

	 }
	</script>
<div style="display:none" id="actCutiPegawai">
	<div class="well light_blue" style="width:500px">
                            <div class="well-content no-search">
							<form id="aksiform" name="aksiform">
	<input type="hidden" id="idcuti" name="idcuti"> 

                                <table class="table table-hover">
                                   <thead>
                                      <tr>
                                         <th>Approve</th>
                                         <th><input type="radio" class="uniform" name="ra" id="ra" value="A"></th>
                                      </tr>
                                      <tr>
                                         <th>Tolak</th>
                                         <th><input type="radio" class="uniform" name="ra" id="ra" value="T"></th>
                                      </tr>
                                      <tr>
                                         <th>Kembalikan</th>
                                         <th><input type="radio" class="uniform" name="ra" id="ra" value="K"></th>
                                      </tr>
                                   </thead>
                                </table>
	</form>					

                            </div>
                        </div>
</div>	
<div id="tabledata">
<div class="span12">
		 
<br>
											<div class="well grey">
												<div class="well-header">
													<h5>List Pegawai </h5>
													</div>
										
													<div class="well-content">
													<div class="table_options top_options">
													</div>

 <table class="table multimedia table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Detail</th>
                                            <th>Nik Pegawai </th>
                                            <th>Nama Pegawai </th>
                                            <th>Status </th>
                                            <th>Tanggal </th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
									 	<?php  if(!empty($query)) { foreach($query as $row) { ?> 
                                        <tr>
                                            <td>
											<img onclick="return detailData(<?php echo $row->id ?>)" style="height:15px;margin-left:10px;;width:15px" src="<?php echo base_url()?>img/plus.png" 
											alt="Avatar"></td>
                                            <td style="text-align:center;font-weight:bold">
											<span class="label label-warning"><?php echo $row->nik ?></span>
											</td>
                                            <td><?php echo $row->nama ?></td>
                                            <td><?php  if($row->kodeabsensi=='1'){echo"<b>KEDATANGAN</b>";} else {echo"KEPULANGAN";} ?></td>
                                            <td><?php echo date('d-F-Y', strtotime($row->tanggal));    ?></td>
                                            
                                          
                                        </tr>
										<tr style="display:none" id="tr<?php echo $row->id ?>">
											<td colspan="10" id="detail<?php echo $row->id ?>">
										</td>
										</tr>
										<?php }} ?>
                                    </tbody>
                                </table><br>
								 <p class="pages"> <?php echo $this->pagination->create_links(); ?></p>		
								 </div>
								 
								 <div class="table_options bottom_options">
													</div>
											  </div>
											</div>
										</div>