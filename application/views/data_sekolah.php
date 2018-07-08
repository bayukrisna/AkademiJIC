<?php 
  foreach($getPreschool as $row)
  { 
    echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
  }
?>
