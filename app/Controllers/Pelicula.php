<?php 

namespace App\Controllers;

class Pelicula extends BaseController{

    public function index()
    {
        echo 'Soy el método index!';
    }
    
    public function new()
    {
        echo view('pelicula/create');
    }
    
    public function create()
    {
        echo "Esta vivo...<br>VIIIVOOO!!!! <br><b>(╯°□°）╯︵ ┻━┻</b>";
    }
    
    public function edit($id)
    {
        echo view('pelicula/edit');
    }
    
    public function update($id)
    {
        echo "[$id] Buaaaaa!!!! <br/><b>ಥ_ಥ</b> ";
    }
    
    public function test($x =null, $n = null)
    {
        echo 'Soy el método test!... Prueba #'.$x." ".$n;
    }
    
    
}