
<html>
    <?php
        $profnumber = Session::get('numero');
        $utilizador = Session::get('user');
        $query = DB::table("Utilizador_Projecto")->where('numero_utilizador',$profnumber)->get();
        
        foreach ($query as $queryresult){
            $query2 = DB::table("Projecto")->where('id',$queryresult->id_projecto)->get();
        }
        foreach ($query2 as $query2result){
            ?><a href="/projeto/{{ $query2result->id }}">{{ $query2result->nome }}</a> 
            <?php 
        }
    ?>


<html>