<?php

declare(strict_types=1);

class Main implements DatabaseWrapper
{
    private string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function insert(array $tableColumns, array $values): array
    {
        $pdo = new PDO("sqlite:./identifier.sqlite");
        $columns = $this->getColumns($pdo, $this->table);

        if (count($tableColumns) === count($values) && count($columns) === count($tableColumns)) {
            $columnsStr = implode(', ', $tableColumns);

            $columnsStrStmt = "";
            $columnsArrStmt = [];
            $result = [];

            foreach ($tableColumns as $key => $column) {
                if (count($tableColumns) !== +$key + 1) {
                    $columnsStrStmt .= ":$column, ";
                } else {
                    $columnsStrStmt .= ":$column";
                }
                $columnsArrStmt[] = ":$column";
                $result[$column] = $values[$key];
            }

            $sqlInsert = "INSERT INTO $this->table ($columnsStr) VALUES ($columnsStrStmt)";
            $stmt = $pdo->prepare($sqlInsert);

            foreach ($columnsArrStmt as $key => $column) {
                $stmt->bindValue($column, $values[$key]);
            }
            $stmt->execute();

            return $result;
        }
        return [];
    }

    public function update(int $id, array $values): array
    {
        $pdo = new PDO("sqlite:./identifier.sqlite");
        $columns = $this->getColumns($pdo, $this->table);

        if (count($values) <= count($columns)) {
            $columnsStrStmt = "";
            $num = 1;

            foreach ($values as $key => $value) {
                $isKey = array_search($key, $columns, true);
                if ($isKey === '') {
                    return [];
                }
                if (count($values) > $num) {
                    $columnsStrStmt .= "'" . $key . "' = '" . $value . "'" . ", ";
                    $num++;
                } else {
                    $columnsStrStmt .= "'" . $key . "' = '" . $value . "'";
                }
            }

            $sqlUpdate = "UPDATE $this->table SET $columnsStrStmt WHERE id = $id";
            $pdo->query($sqlUpdate);

            return $values;

        } else {
            return [];
        }
    }

    public function find(int $id): array
    {
        $pdo = new PDO("sqlite:./identifier.sqlite");
        $columns = $this->getColumns($pdo, $this->table);
        $columnsStr = "";
        $columnsArr = [];

        foreach ($columns as $key => $column) {
            if (count($columns) !== +$key + 1) {
                $columnsStr .= $column . ", ";
            } else {
                $columnsStr .= $column;
            }
        }

        $sth = $pdo->query("SELECT $columnsStr FROM $this->table WHERE id = $id");
        $rows = $sth->fetchAll();

        if (count($rows) > 0) {
            foreach ($columns as $column) {
                $columnsArr[$column] = $rows[0][$column];
            }
            return $columnsArr;
        } else {
            return [];
        }

    }

    public function delete(int $id): bool
    {
        $rows = $this->find($id);
        $pdo = new PDO("sqlite:./identifier.sqlite");
        if (count($rows) > 0) {
            $pdo->query("DELETE FROM $this->table WHERE id = $id");
            return true;
        } else {
            return false;
        }
    }

      public function getColumns(object $pdo, string $table): array
      {
          $sth = $pdo->query("SELECT name FROM PRAGMA_TABLE_INFO('$table')");
          $rows = $sth->fetchAll();
          $columns = [];

          foreach ($rows as $row) {
              $columns[] = $row['name'];
          }

          return $columns;
      }
}

//implements DatabaseWrapper