<?php
	class DeleteMaterial extends CI_Controller 
	{
		function __construct()
		{		
			parent::__construct();
		}
		
		public function index()
		{
			$this->load->view('deleteMaterial/deletematerial');
		}
        
		public function showMaterials()
		{
			$this->load->database();
       
			$keyword = $this->input->post('delete_keyword');
			$type = $this->input->post('material_type');
			$field = $this->input->post('material_field');
     
			$sql  = "SELECT * FROM ".$type." WHERE ".$field." LIKE '%".$keyword."%' ";
			$query = $this->db->query($sql);
			$row = $query->row_array();             

			if($query->num_rows() > 0)
			{
				echo '<table>';
				echo '<tr>';
				echo '<td>Title</td>';
				echo '<td>Author</td>';
				echo '<td>Account Number</td>';
				echo '<td>Call Number</td>';
				echo '<td>Delete Material</td>';
				echo '</tr>';
			}
			else
			{
				echo 'YOUR SEARCH KEYWORD DID NOT MATCH ANYTHING.';
			}
         
         for($i=0; $i<$query->num_rows(); $i++)
        {
            $this->load->helper('url');
			if($i==0)
			{
				$row = $query->row();
				echo '<tr>';
				echo '<td>'.$row->Title.'</td>';
				echo '<td>'.$row->Author.'</td>';
				echo '<td>'.$row->AccountNumber.'</td>';
				echo '<td>'.$row->CallNumber.'</td>';
				echo '<td><form action="'.base_url().'index.php/deleteMaterial/deletemanager/deletefunc/'.$type.'/'.$row->Title.'/'.$row->AccountNumber.'" method="POST"><input type="submit" class="deletematerial_button" value ="DELETE"/></form></td>';
				echo '</tr>';
			}
			else
			{
				echo '<tr>';
				echo '<td>'.$row->Title.'</td>';
				echo '<td>'.$row->Author.'</td>';
				echo '<td>'.$row->AccountNumber.'</td>';
				echo '<td>'.$row->CallNumber.'</td>';
				echo '<td><form action="'.base_url().'index.php/deleteMaterial/deletemager/deletefunc/'.$type.'/'.$row->Title.'/'.$row->AccountNumber.'" method="POST"><input type="submit" class="deletematerial_button" value ="DELETE"/></form></td>';
				echo '</tr>';
			}
			$row=$query->next_row();
        }
        
        echo '</table>'; 
		}
   }
?>