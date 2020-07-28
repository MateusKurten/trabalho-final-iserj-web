<?php
    function DBExecute($query){
        $link = DBConnect();
        $result = mysqli_query($link, $query) or die (mysqli_error($link));
        
        DBClose($link);
        return $result;
    }

    //Ler registros da tabela com parametros (retorna um array)
    function DBRead($fields = '*', $table, $params = null){
        $query = "SELECT {$fields} from {$table} {$params}";
        $result = DBExecute($query);

        if (!mysqli_num_rows($result)){
            return false;
        }else {
            while ($res = mysqli_fetch_assoc($result)){
                $data[] = $res;
            }
        }
        
        return $data;
    }


    //Ler registros da tabela com a query (retorna um array)
    function DBReadQuery($query){
       
        $result = DBExecute($query);

        if (!mysqli_num_rows($result)){
            return false;
        }else {
            while ($res = mysqli_fetch_assoc($result)){
                $data[] = $res;
            }
        }
        
        return $data;
    }

    function DBEscape($variavel){
        $link = DBConnect();
        $variavelEscapada = mysqli_real_escape_string ( $link , $variavel);
        $variavelEscapada = htmlspecialchars($variavelEscapada);
        DBClose($link);
        return $variavelEscapada;
    }

?>