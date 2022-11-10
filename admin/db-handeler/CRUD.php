<?php
trait query_command
{
    public function insert(string $table_name, $data)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table_name,
            implode(', ', array_keys($data)),
            implode(',', array_values($data))
        );
        $this->execute_sql($sql);
    }

    public function delete(string $table_name, string $condition = '')
    {
        $sql = "delete from $table_name";
        $condition = empty($condition) ? "" : "where $condition";
        $this->execute_sql("$sql $condition");
    }

    public function update(string $table_name, $data, string $condition = "")
    {
        $col_equal_val = array();
        foreach ($data as $key => $val) {
            $col_equal_val[] =  is_string($val) ? "$key = '$val'" : "$key = $val";
        }

        $sql = sprintf(
            "update %s set %s %s",
            $table_name,
            implode(',', $col_equal_val),
            empty($condition) ? "" : "where $condition"
        );
        $this->execute_sql($sql);
    }


    public function select(string $table_name, string $column, string $where_condition = "")
    {

        $sql = "select $column from $table_name";
        $sql_where_condition = empty($where_condition) ? "" : "where $where_condition";
        $result = $this->execute_sql("$sql $sql_where_condition");
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    public function join(string $table_name1, string $table_name2, string $select_columns, string $on_condition = "", string $where_condition = "")
    {
        $sql = "select $select_columns from $table_name1 join $table_name2";
        $sql_on_condition = empty($on_condition) ? "" : "on $on_condition";
        $sql_where_condition = empty($where_condition) ? "" : "where $where_condition";
        $result = $this->execute_sql("$sql $sql_on_condition $sql_where_condition");
        // $result = mysqli_fetch_array($result);
        return $result;
    }
}
