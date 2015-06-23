<?php
    session_start();

    include("../mysql.php");
   
    $page = 1; // The current page
    $sortname = 'viimeksikaynyt'; // Sort column
    $sortorder = 'desc'; // Sort order
    $qtype = ''; // Search column
    $query = ''; // Search string
    $rp = 10;
    
    // Get posted data
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
    }
    if (isset($_POST['sortname'])) {
        $sortname = $_POST['sortname'];
    }
    if (isset($_POST['sortorder'])) {
        $sortorder = $_POST['sortorder'];
    }
    if (isset($_POST['qtype'])) {
        $qtype = $_POST['qtype'];
    }
    if (isset($_POST['query'])) {
        $query = $_POST['query'];
    }
    if (isset($_POST['rp'])) {
        $rp = $_POST['rp'];
    }
    
    // Setup sort and search SQL using posted data
    $sortSql = "ORDER BY $sortname $sortorder";
    $searchSql = ($qtype != '' && $query != '') ? "WHERE $qtype = '$query'" : '';
    
    // Get total count of records
    $sql = "SELECT COUNT(*) FROM kayttajat $searchSql";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $total = $row[0];
    
    // Setup paging SQL
    $pageStart = ($page-1)*$rp;
    $limitSql = "LIMIT $pageStart, $rp";
    
    // Return JSON data
    $data = array();
    $data['page'] = $page;
    $data['total'] = $total;
    $data['rows'] = array();

    $sql = "SELECT * FROM kayttajat $searchSql $sortSql $limitSql";
    
    $results = mysqli_query($con, $sql) or die(mysqli_error($con));

    while ($row = mysqli_fetch_assoc($results)) {
        $data['rows'][] = array(
            'id' => $row['id'],
            'cell' => array(
                $row['nimi'],
                $row['salasana'],
                $row['viimeksikaynyt'],
                $row['kirjautumiskerrat'],
                $row['kayntikerrat'],
                $row['laskentakerrat'],
                $row['lahetyskerrat'],
                $row['tallennuskerrat'],
                $row['tulostuskerrat'],
                $row['tuotekatselukerrat'])
        );
    }

    echo json_encode($data);
?>