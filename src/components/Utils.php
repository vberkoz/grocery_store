<?php


class Utils
{
    public static function hash()
    {
        return sprintf( '%04x%04x%04x',
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    public static function storage(array $p)
    {
        $columns = $p['columns'];
        $table = $p['table'];
        $joins = '';
        if (isset($p['joins'])) {
            foreach ($p['joins'] as $i) {
                $joinTable = $i['table'];
                $joinExpresion = $i['expresion'];
                $joins .= " LEFT JOIN $joinTable ON $joinExpresion";
            }
        }
        $conditions = $p['conditions'];
        $s = "SELECT $columns FROM $table $joins WHERE $conditions";

        $db = Db::getConnection();
        $r = $db->prepare($s);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetchAll();
    }
}
