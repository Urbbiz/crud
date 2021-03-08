<?php
function readData()  : array   // funkcia nuskaito duomenis is json failo.
{
  if(!file_exists(DIR.'data/boxes.json')) {   //pirma karta sukuriam jspn faila
        $data = json_encode([]);
        file_put_contents(DIR.'data/boxes.json', $data);
  }

  $data = file_get_contents(DIR.'data/boxes.json');
  return json_decode($data, 1);  // rasom 1, kad grazinu array, o ne pbjekta.
}

function writeData(array $data) : void  // funkcia nieko negrazina, bet paduodam jai array, kitaip bus blogai.
{
    $data = json_encode($data);
    file_put_contents(DIR.'data/boxes.json', $data);
}

function getBox(int $id) : ?array   // grazina areju su tos dezes informacija, kurios pateikeme $id
{
    foreach(readData() as $box) {
        if ($box['id'] == $id) {
            return $box;
        }
    }
    return null;
}

function create(int $count) : void
{
$boxes = readData();
$id = getNextId();
$box = ['id'=> $id, 'apple'=>$count];
$boxes[] = $box;
writeData($boxes);
}

function update(int $id, int $count) : void
{
    $boxes = readData();// visai visi
    $box = getBox($id);
    if(!$box) {
        return;
    }
    $box['apple'] = $count;
    deleteBox($id);
    $boxes = readData(); // visi be istrinto
    $boxes[] = $box; 
    writeData($boxes);
}

function deleteBox(int $id) : void
{
    $boxes = readData();
    foreach($boxes as $key => $box) {
        if ($box['id'] == $id) {
            unset($boxes[$key]);
            writeData($boxes);
            return;
        }
    }
}



function getNextId() : int
{
    if(!file_exists(DIR.'data/indexes.json')) {   //pirma karta sukuriam json faila indeksams
        $index = json_encode(['id'=>1]);
        file_put_contents(DIR.'data/indexes.json', $index);
  }
  $index = file_get_contents(DIR.'data/indexes.json');
  $index = json_decode($index, 1);
  $id = (int) $index['id'];
  $index['id'] = $id + 1;
  $index = json_encode($index);
  file_put_contents(DIR.'data/indexes.json', $index);
  return $id;
}

?>