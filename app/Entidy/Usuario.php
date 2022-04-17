<?php

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Usuario
{


    public $id;

    public $nome;

    public $email;

    public $senha;

    public $cargos_id;

    public $acessos_id;


    public function cadastar()
    {


        $obdataBase = new Database('usuarios');

        $this->id = $obdataBase->insert([

            'nome'               => $this->nome,
            'email'              => $this->email,
            'senha'              => $this->senha,
            'cargos_id'          => $this->cargos_id,
            'acessos_id'         => $this->acessos_id

        ]);

        return true;
    }

    public function atualizar()
    {
        return (new Database('usuarios'))->update('id = ' . $this->id, [

            'nome'               => $this->nome,
            'email'              => $this->email,
            'senha'              => $this->senha,
            'cargos_id'          => $this->cargos_id,
            'acessos_id'         => $this->acessos_id
        ]);
    }


    public static function getList($fields = null, $table = null, $where = null, $order = null, $limit = null)
    {

        return (new Database('usuarios'))->select($fields, $table, $where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }



    public static function getQtd($fields = null, $table = null, $where = null, $order = null, $limit = null)
    {

        return (new Database('usuarios'))->select('COUNT(*) as qtd', 'usuarios', null, null)
            ->fetchObject()
            ->qtd;
    }


    public static function getID($fields, $table, $where, $order, $limit)
    {
        return (new Database('usuarios'))->select($fields, $table, $where, $order, $limit)
            ->fetchObject(self::class);
    }


    public function excluir()
    {
        return (new Database('usuarios'))->delete('id = ' . $this->id);
    }


    public static function getUsuarioPorEmail($email)
    {

        return (new Database('usuarios'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}
