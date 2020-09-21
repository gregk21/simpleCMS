<?php 

function admin_topnav()
{
    Append_Title("Administer Top Navigation Links"); 

    Append_Content("Administer Top Navigation Links"); 

}
// shows a navigation bar with modules that user has permission to use
function Show_links_table()
{
    $query = new Query(new DB()); 
    $query->SetTableName("topnav"); 
    $query->Select(['linkid','link_path','link_text','weight']); 
    $query->OrderBy(['weight']); 
    $query->Run(); 
    $result= $query->GetReturnedRows();

    
    
    $rows = $result[0]; 
        
}

?>