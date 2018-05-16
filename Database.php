<?php
require_once("Sql.php");
// Lê do banco de dados
function DBRead($table, $fields = '*', $params = NULL){
    $conn = DBConnect();
    $params = ($params) ? " {$params}" : NULL; 
    
    $query = "SELECT {$fields} FROM {$table}{$params}";
    $result = @sqlsrv_query($conn, $query, array(), array( "Scrollable" => 'static' )) or die(sqlsrv_errors());;

    if (!sqlsrv_num_rows($result)) {
        return false;
    } else {
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            $data[] = $row  ;
        }
        return $data;
    }
    DBClose($conn);
}

function DBAtendimentoByDateRangeRead($dataInicio, $dataFim){
    $conn = DBConnect();
    $query = "SELECT senha, hrinicio, nomedoador, 
                    hrtermino, nmpacie, tipodoa, 
                    convert(varchar,dtatend, 103) AS Data , hospital 
              FROM atendim
              WHERE dtatend BETWEEN '{$dataInicio}' AND '{$dataFim}' ORDER BY dtatend, senha ";
    $result = @sqlsrv_query($conn, $query, array(), array( "Scrollable" => 'static' )) or die(sqlsrv_errors());;

    if (!sqlsrv_num_rows($result)) {
        return false;
    } else {
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            $data[] = $row  ;
        }
        return $data;
    }
    DBClose($conn);
}
?>