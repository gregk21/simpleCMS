<?php 
function theme_manager()
{
    Append_Content("<h2>Here you can change your theme !</h2>");

    $url= new URL(); 
    $url_array= $url->GetURLArray(); 
    $url=null;
   
    if (array_key_exists('id',$url_array) && $url_array['id'])
    {
        Append_Content("<h3>Theme has changed to ID: <h3>".$url_array['id']);
        Append_Content("<br>");
            Append_Content("<br></b><a class='link-button col-60' href=".CMS_BASE_URL."?q=theme_manager/> Go Back </a>");

        $query = new Query(new DB());
        $query->SetTableName('theme_registry');
        $query->Update(['status'=>0]);
        $query->Run();

        $query = new Query(new DB());
        $query->SetTableName('theme_registry');
        $query->Update(['status'=>1]);
        $query->Where(['themeid', '=' , $url_array['id']]);
        $query->Run();

        // $result = $query->getSQL();
        
        $query = null;
        // var_dump($result);

    }
    else
    {
        Append_Content(show_themes_table());
    }
    
}

function show_themes_table()
{

    

    $query = new Query(new DB());
    $query->SetTableName('theme_registry');
    $query->Select(['themeid','theme_display_name','status']);
    $query->Run();
    $result = $query->GetReturnedRows();
    $query = null;



    $themes= array(); 

    foreach ($result as $row){
        $themes[]= [
            'themeid'=>$row['themeid'],
            'theme_display_name'=>$row['theme_display_name'],
            'status'=>$row['status']
        ];
    }

    $table= "<table class='users-table' border=1>"; 
    $table.= "<thead> <tr> <th class='th-section-header' colspan=3> Themes </th></tr>";
    $table.= "<tr> <th> Theme Name </th><th> Action </th></tr> </thead>"; 
    foreach ($themes as $theme){
        $table.= "<tr>"; 
        $table.= "<td class='form-container'> {$theme['theme_display_name']} </td>"; 
        $link_button= "<a class='link-button full' href=".CMS_BASE_URL."?q=theme_manager/".$theme['themeid']." style=color:white > Select </a>"; 
        $table.= "<td>{$link_button}</td>"; 
        $table.= "</tr>"; 
    }
    $table.= "</table>"; 

    return $table;
}

?>