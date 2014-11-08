<?php
/*
@author Abdul Aziz <azizbabu10@yahoo.com>
GitHub: github.com/azizbabu
This call finds the optimized path for a sentance from a keyboard.
Dijkstra algorithm is used to find the optimized path
Solution for:
RemissionSoft
Talent Test
Web Programmer(PHP)
*/
class Keyboard
{
private $vertex = array();
// array of predecessors for each vertex
private $predecessors = array();
// queue of all unoptimized vertices
private $queue;
private $source;
private $target;
public function __construct() {
$this->queue = new SplPriorityQueue();
}
public function findOptimumPath($sentence) {
$response = '';
if( strlen( $sentence ) <= 1)
$response = "Enter ( $sentence )";
else{
$a = str_split( $sentence , 1 );
for ($i=0; $i < count( $a ) - 1 ; $i++) {
$arr =( $this->getOptimumPath($a[ $i ] , $a[ $i + 1] ) );
if( $i != count( $a ) - 2 )
$response.= implode( array_splice( $arr, 0, count($arr)-1 ) , ' - > ') . '<br>';
else
$response.= implode( ( $arr ) , ' - > ' ) . '<br>';
}
}
return $response;
}
private function getOptimumPath($source, $target) {
$this->source = $source;
$this->target = $target;
// array of best estimates of shortest path to each
$this->prepareQueue();
//print_r( $this->vertex );
// initial distance at source is 0
$this->minimumDistance();
// we can now find the shortest path using reverse
return $this->getShortestPath();
}
private function prepareQueue(){
foreach ($this->graph as $v => $adj) {
$this->vertex[$v] = INF; // set initial distance to "infinity"
$this->predecessors[$v] = null; // no known predecessors yet
foreach ($adj as $w => $meta) {
// use the edge cost as the priority
$this->queue->insert($w , $meta['w']);
}
}
}
private function minimumDistance(){
$this->vertex[$this->source] = 0;
while (!$this->queue->isEmpty()) {
// extract min cost
$u = $this->queue->extract();
if (!empty($this->graph[$u])) {
// "relax" each adjacent vertex
foreach ($this->graph[$u] as $v => $meta) {
// alternate route length to adjacent neighbor
$alt = $this->vertex[$u] + $meta['w'];
// if alternate route is shorter
if ($alt <= $this->vertex[$v]) {
$this->vertex[$v] = $alt; // update minimum length to vertex
$this->predecessors[$v] = $u; // add neighbor to predecessors
// for vertex
}
}
}
}
}
private function getShortestPath( ){
$stack = new SplStack(); // shortest path with a stack
$u = $this->target;
$dist = 0;
$stack->push("Enter($this->target)" );
// traverse from target to source
while (isset($this->predecessors[$u]) && $this->predecessors[$u]) {
$stack->push( $this->graph[$this->predecessors[$u]][$u]['d'] );
$dist += $this->graph[$this->predecessors[$u]][$u]['w']; // add distance to predecessor
$u = $this->predecessors[$u];
}
// stack will be empty if there is no route back
if ($stack->isEmpty()) {
echo "No route from $source to $this->target";
}
else {
// add the source node and print the path in reverse
// (LIFO) order
$key = $this->source== " "? 'space' : $this->source;
$stack->push("Enter($key)");
$traces = array();
foreach ($stack as $v)
$traces[] = $v ;
return $traces;
}
}
private $graph = array(
"A" => array(
"B" => array("w" => 1, "d" => "Right"),
"a" => array("w" => 1, "d" => "Down"),
"`" => array("w" => 1, "d" => "Up")
),
"B" => array(
"C" => array("w" => 1, "d" => "Right"),
"A" => array("w" => 1, "d" => "Left"),
"b" => array("w" => 1, "d" => "Down"),
"~" => array("w" => 1, "d" => "Up")
),
"C" => array(
"D" => array("w" => 1, "d" => "Right"),
"B" => array("w" => 1, "d" => "Left"),
"c" => array("w" => 1, "d" => "Down"),
"[" => array("w" => 1, "d" => "Up")
),
"D" => array(
"E" => array("w" => 1, "d" => "Right"),
"C" => array("w" => 1, "d" => "Left"),
"d" => array("w" => 1, "d" => "Down"),
"]" => array("w" => 1, "d" => "Up")
),
"E" => array(
"F" => array("w" => 1, "d" => "Right"),
"D" => array("w" => 1, "d" => "Left"),
"e" => array("w" => 1, "d" => "Down"),
"{" => array("w" => 1, "d" => "Up")
),
"F" => array(
"G" => array("w" => 1, "d" => "Right"),
"E" => array("w" => 1, "d" => "Left"),
"f" => array("w" => 1, "d" => "Down"),
"}" => array("w" => 1, "d" => "Up")
),
"G" => array(
"H" => array("w" => 1, "d" => "Right"),
"F" => array("w" => 1, "d" => "Left"),
"g" => array("w" => 1, "d" => "Down"),
"<" => array("w" => 1, "d" => "Up")
),
"H" => array(
"I" => array("w" => 1, "d" => "Right"),
"G" => array("w" => 1, "d" => "Left"),
"h" => array("w" => 1, "d" => "Down"),
">" => array("w" => 1, "d" => "Up")
),
"I" => array(
"J" => array("w" => 1, "d" => "Right"),
"H" => array("w" => 1, "d" => "Left"),
"i" => array("w" => 1, "d" => "Down"),
" " => array("w" => 1, "d" => "Up")
),
"J" => array(
"K" => array("w" => 1, "d" => "Right"),
"I" => array("w" => 1, "d" => "Left"),
"j" => array("w" => 1, "d" => "Down"),
" " => array("w" => 1, "d" => "Up")
),
"K" => array(
"L" => array("w" => 1, "d" => "Right"),
"J" => array("w" => 1, "d" => "Left"),
"k" => array("w" => 1, "d" => "Down"),
" " => array("w" => 1, "d" => "Up")
),
"L" => array(
"M" => array("w" => 1, "d" => "Right"),
"K" => array("w" => 1, "d" => "Left"),
"l" => array("w" => 1, "d" => "Down"),
" " => array("w" => 1, "d" => "Up")
),
"M" => array(
"N" => array("w" => 1, "d" => "Right"),
"L" => array("w" => 1, "d" => "Left"),
"m" => array("w" => 1, "d" => "Down"),
" " => array("w" => 1, "d" => "Up")
),
"N" => array(
"O" => array("w" => 1, "d" => "Right"),
"M" => array("w" => 1, "d" => "Left"),
"n" => array("w" => 1, "d" => "Down"),
" " => array("w" => 1, "d" => "Up")
),
"O" => array(
"P" => array("w" => 1, "d" => "Right"),
"N" => array("w" => 1, "d" => "Left"),
"o" => array("w" => 1, "d" => "Down"),
" " => array("w" => 1, "d" => "Up")
),
"P" => array(
"Q" => array("w" => 1, "d" => "Right"),
"O" => array("w" => 1, "d" => "Left"),
"p" => array("w" => 1, "d" => "Down"),
" " => array("w" => 1, "d" => "Up")
),
"Q" => array(
"R" => array("w" => 1, "d" => "Right"),
"P" => array("w" => 1, "d" => "Left"),
"q" => array("w" => 1, "d" => "Down"),
"." => array("w" => 1, "d" => "Up")
),
"R" => array(
"S" => array("w" => 1, "d" => "Right"),
"Q" => array("w" => 1, "d" => "Left"),
"r" => array("w" => 1, "d" => "Down"),
"," => array("w" => 1, "d" => "Up")
),
"S" => array(
"T" => array("w" => 1, "d" => "Right"),
"R" => array("w" => 1, "d" => "Left"),
"s" => array("w" => 1, "d" => "Down"),
";" => array("w" => 1, "d" => "Up")
),
"T" => array(
"U" => array("w" => 1, "d" => "Right"),
"S" => array("w" => 1, "d" => "Left"),
"t" => array("w" => 1, "d" => "Down"),
":" => array("w" => 1, "d" => "Up")
),
"U" => array(
"V" => array("w" => 1, "d" => "Right"),
"T" => array("w" => 1, "d" => "Left"),
"u" => array("w" => 1, "d" => "Down"),
"'" => array("w" => 1, "d" => "Up")
),
"V" => array(
"W" => array("w" => 1, "d" => "Right"),
"U" => array("w" => 1, "d" => "Left"),
"v" => array("w" => 1, "d" => "Down"),
"\"" => array("w" => 1, "d" => "Up")
),
"W" => array(
"X" => array("w" => 1, "d" => "Right"),
"V" => array("w" => 1, "d" => "Left"),
"w" => array("w" => 1, "d" => "Down"),
"_" => array("w" => 1, "d" => "Up")
),
"X" => array(
"Y" => array("w" => 1, "d" => "Right"),
"W" => array("w" => 1, "d" => "Left"),
"x" => array("w" => 1, "d" => "Down"),
"=" => array("w" => 1, "d" => "Up")
),
"Y" => array(
"Z" => array("w" => 1, "d" => "Right"),
"X" => array("w" => 1, "d" => "Left"),
"y" => array("w" => 1, "d" => "Down"),
"BS" => array("w" => 1, "d" => "Up")
),
"Z" => array(
"Y" => array("w" => 1, "d" => "Left"),
"z" => array("w" => 1, "d" => "Down"),
"BS" => array("w" => 1, "d" => "Up")
),
"a" => array(
"b" => array("w" => 1, "d" => "Right"),
"0" => array("w" => 1, "d" => "Down"),
"A" => array("w" => 1, "d" => "Up")
),
"b" => array(
"c" => array("w" => 1, "d" => "Right"),
"a" => array("w" => 1, "d" => "Left"),
"1" => array("w" => 1, "d" => "Down"),
"B" => array("w" => 1, "d" => "Up")
),
"c" => array(
"d" => array("w" => 1, "d" => "Right"),
"b" => array("w" => 1, "d" => "Left"),
"2" => array("w" => 1, "d" => "Down"),
"C" => array("w" => 1, "d" => "Up")
),
"d" => array(
"e" => array("w" => 1, "d" => "Right"),
"c" => array("w" => 1, "d" => "Left"),
"3" => array("w" => 1, "d" => "Down"),
"D" => array("w" => 1, "d" => "Up")
),
"e" => array(
"f" => array("w" => 1, "d" => "Right"),
"d" => array("w" => 1, "d" => "Left"),
"4" => array("w" => 1, "d" => "Down"),
"E" => array("w" => 1, "d" => "Up")
),
"f" => array(
"g" => array("w" => 1, "d" => "Right"),
"e" => array("w" => 1, "d" => "Left"),
"5" => array("w" => 1, "d" => "Down"),
"F" => array("w" => 1, "d" => "Up")
),
"g" => array(
"h" => array("w" => 1, "d" => "Right"),
"f" => array("w" => 1, "d" => "Left"),
"6" => array("w" => 1, "d" => "Down"),
"G" => array("w" => 1, "d" => "Up")
),
"h" => array(
"i" => array("w" => 1, "d" => "Right"),
"g" => array("w" => 1, "d" => "Left"),
"7" => array("w" => 1, "d" => "Down"),
"H" => array("w" => 1, "d" => "Up")
),
"i" => array(
"j" => array("w" => 1, "d" => "Right"),
"h" => array("w" => 1, "d" => "Left"),
"8" => array("w" => 1, "d" => "Down"),
"I" => array("w" => 1, "d" => "Up")
),
"j" => array(
"k" => array("w" => 1, "d" => "Right"),
"i" => array("w" => 1, "d" => "Left"),
"9" => array("w" => 1, "d" => "Down"),
"J" => array("w" => 1, "d" => "Up")
),
"k" => array(
"l" => array("w" => 1, "d" => "Right"),
"j" => array("w" => 1, "d" => "Left"),
"!" => array("w" => 1, "d" => "Down"),
"K" => array("w" => 1, "d" => "Up")
),
"l" => array(
"m" => array("w" => 1, "d" => "Right"),
"k" => array("w" => 1, "d" => "Left"),
"@" => array("w" => 1, "d" => "Down"),
"L" => array("w" => 1, "d" => "Up")
),
"m" => array(
"n" => array("w" => 1, "d" => "Right"),
"l" => array("w" => 1, "d" => "Left"),
"#" => array("w" => 1, "d" => "Down"),
"M" => array("w" => 1, "d" => "Up")
),
"n" => array(
"o" => array("w" => 1, "d" => "Right"),
"m" => array("w" => 1, "d" => "Left"),
"$" => array("w" => 1, "d" => "Down"),
"N" => array("w" => 1, "d" => "Up")
),
"o" => array(
"p" => array("w" => 1, "d" => "Right"),
"n" => array("w" => 1, "d" => "Left"),
"%" => array("w" => 1, "d" => "Down"),
"O" => array("w" => 1, "d" => "Up")
),
"p" => array(
"q" => array("w" => 1, "d" => "Right"),
"o" => array("w" => 1, "d" => "Left"),
"^" => array("w" => 1, "d" => "Down"),
"P" => array("w" => 1, "d" => "Up")
),
"q" => array(
"r" => array("w" => 1, "d" => "Right"),
"p" => array("w" => 1, "d" => "Left"),
"&" => array("w" => 1, "d" => "Down"),
"Q" => array("w" => 1, "d" => "Up")
),
"r" => array(
"s" => array("w" => 1, "d" => "Right"),
"q" => array("w" => 1, "d" => "Left"),
"*" => array("w" => 1, "d" => "Down"),
"R" => array("w" => 1, "d" => "Up")
),
"s" => array(
"t" => array("w" => 1, "d" => "Right"),
"r" => array("w" => 1, "d" => "Left"),
"(" => array("w" => 1, "d" => "Down"),
"S" => array("w" => 1, "d" => "Up")
),
"t" => array(
"u" => array("w" => 1, "d" => "Right"),
"s" => array("w" => 1, "d" => "Left"),
")" => array("w" => 1, "d" => "Down"),
"T" => array("w" => 1, "d" => "Up")
),
"u" => array(
"v" => array("w" => 1, "d" => "Right"),
"t" => array("w" => 1, "d" => "Left"),
"?" => array("w" => 1, "d" => "Down"),
"U" => array("w" => 1, "d" => "Up")
),
"v" => array(
"w" => array("w" => 1, "d" => "Right"),
"u" => array("w" => 1, "d" => "Left"),
"/" => array("w" => 1, "d" => "Down"),
"V" => array("w" => 1, "d" => "Up")
),
"w" => array(
"x" => array("w" => 1, "d" => "Right"),
"v" => array("w" => 1, "d" => "Left"),
"|" => array("w" => 1, "d" => "Down"),
"W" => array("w" => 1, "d" => "Up")
),
"x" => array(
"y" => array("w" => 1, "d" => "Right"),
"w" => array("w" => 1, "d" => "Left"),
"\\" => array("w" => 1, "d" => "Down"),
"X" => array("w" => 1, "d" => "Up")
),
"y" => array(
"z" => array("w" => 1, "d" => "Right"),
"x" => array("w" => 1, "d" => "Left"),
"+" => array("w" => 1, "d" => "Down"),
"Y" => array("w" => 1, "d" => "Up")
),
"z" => array(
"y" => array("w" => 1, "d" => "Left"),
"-" => array("w" => 1, "d" => "Down"),
"Z" => array("w" => 1, "d" => "Up")
),
"0" => array(
"1" => array("w" => 1, "d" => "Right"),
"`" => array("w" => 1, "d" => "Down"),
"a" => array("w" => 1, "d" => "Up")
),
"1" => array(
"2" => array("w" => 1, "d" => "Right"),
"0" => array("w" => 1, "d" => "Left"),
"~" => array("w" => 1, "d" => "Down"),
"b" => array("w" => 1, "d" => "Up")
),
"2" => array(
"3" => array("w" => 1, "d" => "Right"),
"1" => array("w" => 1, "d" => "Left"),
"[" => array("w" => 1, "d" => "Down"),
"c" => array("w" => 1, "d" => "Up")
),
"3" => array(
"4" => array("w" => 1, "d" => "Right"),
"2" => array("w" => 1, "d" => "Left"),
"]" => array("w" => 1, "d" => "Down"),
"d" => array("w" => 1, "d" => "Up")
),
"4" => array(
"5" => array("w" => 1, "d" => "Right"),
"3" => array("w" => 1, "d" => "Left"),
"{" => array("w" => 1, "d" => "Down"),
"e" => array("w" => 1, "d" => "Up")
),
"5" => array(
"6" => array("w" => 1, "d" => "Right"),
"4" => array("w" => 1, "d" => "Left"),
"}" => array("w" => 1, "d" => "Down"),
"f" => array("w" => 1, "d" => "Up")
),
"6" => array(
"7" => array("w" => 1, "d" => "Right"),
"5" => array("w" => 1, "d" => "Left"),
"<" => array("w" => 1, "d" => "Down"),
"g" => array("w" => 1, "d" => "Up")
),
"7" => array(
"8" => array("w" => 1, "d" => "Right"),
"6" => array("w" => 1, "d" => "Left"),
">" => array("w" => 1, "d" => "Down"),
"h" => array("w" => 1, "d" => "Up")
),
"8" => array(
"9" => array("w" => 1, "d" => "Right"),
"7" => array("w" => 1, "d" => "Left"),
" " => array("w" => 1, "d" => "Down"),
"i" => array("w" => 1, "d" => "Up")
),
"9" => array(
"!" => array("w" => 1, "d" => "Right"),
"8" => array("w" => 1, "d" => "Left"),
" " => array("w" => 1, "d" => "Down"),
"j" => array("w" => 1, "d" => "Up")
),
"!" => array(
"@" => array("w" => 1, "d" => "Right"),
"9" => array("w" => 1, "d" => "Left"),
" " => array("w" => 1, "d" => "Down"),
"k" => array("w" => 1, "d" => "Up")
),
"@" => array(
"#" => array("w" => 1, "d" => "Right"),
"!" => array("w" => 1, "d" => "Left"),
" " => array("w" => 1, "d" => "Down"),
"l" => array("w" => 1, "d" => "Up")
),
"#" => array(
"$" => array("w" => 1, "d" => "Right"),
"@" => array("w" => 1, "d" => "Left"),
" " => array("w" => 1, "d" => "Down"),
"m" => array("w" => 1, "d" => "Up")
),
"$" => array(
"%" => array("w" => 1, "d" => "Right"),
"#" => array("w" => 1, "d" => "Left"),
" " => array("w" => 1, "d" => "Down"),
"n" => array("w" => 1, "d" => "Up")
),
"%" => array(
"^" => array("w" => 1, "d" => "Right"),
"$" => array("w" => 1, "d" => "Left"),
" " => array("w" => 1, "d" => "Down"),
"o" => array("w" => 1, "d" => "Up")
),
"^" => array(
"&" => array("w" => 1, "d" => "Right"),
"%" => array("w" => 1, "d" => "Left"),
" " => array("w" => 1, "d" => "Down"),
"p" => array("w" => 1, "d" => "Up")
),
"&" => array(
"*" => array("w" => 1, "d" => "Right"),
"^" => array("w" => 1, "d" => "Left"),
"." => array("w" => 1, "d" => "Down"),
"q" => array("w" => 1, "d" => "Up")
),
"*" => array(
"(" => array("w" => 1, "d" => "Right"),
"&" => array("w" => 1, "d" => "Left"),
"," => array("w" => 1, "d" => "Down"),
"r" => array("w" => 1, "d" => "Up")
),
"(" => array(
")" => array("w" => 1, "d" => "Right"),
"*" => array("w" => 1, "d" => "Left"),
";" => array("w" => 1, "d" => "Down"),
"s" => array("w" => 1, "d" => "Up")
),
")" => array(
"?" => array("w" => 1, "d" => "Right"),
"(" => array("w" => 1, "d" => "Left"),
":" => array("w" => 1, "d" => "Down"),
"t" => array("w" => 1, "d" => "Up")
),
"?" => array(
"/" => array("w" => 1, "d" => "Right"),
")" => array("w" => 1, "d" => "Left"),
"'" => array("w" => 1, "d" => "Down"),
"u" => array("w" => 1, "d" => "Up")
),
"/" => array(
"|" => array("w" => 1, "d" => "Right"),
"?" => array("w" => 1, "d" => "Left"),
"\"" => array("w" => 1, "d" => "Down"),
"v" => array("w" => 1, "d" => "Up")
),
"|" => array(
"\\" => array("w" => 1, "d" => "Right"),
"/" => array("w" => 1, "d" => "Left"),
"_" => array("w" => 1, "d" => "Down"),
"w" => array("w" => 1, "d" => "Up")
),
"\\" => array(
"+" => array("w" => 1, "d" => "Right"),
"|" => array("w" => 1, "d" => "Left"),
"=" => array("w" => 1, "d" => "Down"),
"x" => array("w" => 1, "d" => "Up")
),
"+" => array(
"-" => array("w" => 1, "d" => "Right"),
"\\" => array("w" => 1, "d" => "Left"),
"BS" => array("w" => 1, "d" => "Down"),
"y" => array("w" => 1, "d" => "Up")
),
"-" => array(
"+" => array("w" => 1, "d" => "Left"),
"BS" => array("w" => 1, "d" => "Down"),
"z" => array("w" => 1, "d" => "Up")
),
"`" => array(
"~" => array("w" => 1, "d" => "Right"),
"A" => array("w" => 1, "d" => "Down"),
"0" => array("w" => 1, "d" => "Up")
),
"~" => array(
"[" => array("w" => 1, "d" => "Right"),
"`" => array("w" => 1, "d" => "Left"),
"B" => array("w" => 1, "d" => "Down"),
"1" => array("w" => 1, "d" => "Up")
),
"[" => array(
"]" => array("w" => 1, "d" => "Right"),
"~" => array("w" => 1, "d" => "Left"),
"C" => array("w" => 1, "d" => "Down"),
"2" => array("w" => 1, "d" => "Up")
),
"]" => array(
"{" => array("w" => 1, "d" => "Right"),
"[" => array("w" => 1, "d" => "Left"),
"D" => array("w" => 1, "d" => "Down"),
"3" => array("w" => 1, "d" => "Up")
),
"{" => array(
"}" => array("w" => 1, "d" => "Right"),
"]" => array("w" => 1, "d" => "Left"),
"E" => array("w" => 1, "d" => "Down"),
"4" => array("w" => 1, "d" => "Up")
),
"}" => array(
"<" => array("w" => 1, "d" => "Right"),
"{" => array("w" => 1, "d" => "Left"),
"F" => array("w" => 1, "d" => "Down"),
"5" => array("w" => 1, "d" => "Up")
),
"<" => array(
">" => array("w" => 1, "d" => "Right"),
"}" => array("w" => 1, "d" => "Left"),
"G" => array("w" => 1, "d" => "Down"),
"6" => array("w" => 1, "d" => "Up")
),
">" => array(
" " => array("w" => 1, "d" => "Right"),
"<" => array("w" => 1, "d" => "Left"),
"H" => array("w" => 1, "d" => "Down"),
"7" => array("w" => 1, "d" => "Up")
),
" " => array(
" " => array("w" => 1, "d" => "Right"),
">" => array("w" => 1, "d" => "Left"),
"I" => array("w" => 1, "d" => "Down"),
"8" => array("w" => 1, "d" => "Up")
),
" " => array(
" " => array("w" => 1, "d" => "Right"),
" " => array("w" => 1, "d" => "Left"),
"I" => array("w" => 1, "d" => "Down"),
"#" => array("w" => 1, "d" => "Up")
),
" " => array(
" " => array("w" => 1, "d" => "Right"),
" " => array("w" => 1, "d" => "Left"),
"I" => array("w" => 1, "d" => "Down"),
"#" => array("w" => 1, "d" => "Up")
),
" " => array(
" " => array("w" => 1, "d" => "Right"),
" " => array("w" => 1, "d" => "Left"),
"I" => array("w" => 1, "d" => "Down"),
"#" => array("w" => 1, "d" => "Up")
),
" " => array(
" " => array("w" => 1, "d" => "Right"),
" " => array("w" => 1, "d" => "Left"),
"I" => array("w" => 1, "d" => "Down"),
"#" => array("w" => 1, "d" => "Up")
),
" " => array(
" " => array("w" => 1, "d" => "Right"),
" " => array("w" => 1, "d" => "Left"),
"I" => array("w" => 1, "d" => "Down"),
"#" => array("w" => 1, "d" => "Up")
),
" " => array(
" " => array("w" => 1, "d" => "Right"),
" " => array("w" => 1, "d" => "Left"),
"I" => array("w" => 1, "d" => "Down"),
"#" => array("w" => 1, "d" => "Up")
),
" " => array(
"." => array("w" => 1, "d" => "Right"),
" " => array("w" => 1, "d" => "Left"),
"I" => array("w" => 1, "d" => "Down"),
"#" => array("w" => 1, "d" => "Up")
),
"." => array(
"," => array("w" => 1, "d" => "Right"),
" " => array("w" => 1, "d" => "Left"),
"Q" => array("w" => 1, "d" => "Down"),
"&" => array("w" => 1, "d" => "Up")
),
"," => array(
";" => array("w" => 1, "d" => "Right"),
"." => array("w" => 1, "d" => "Left"),
"R" => array("w" => 1, "d" => "Down"),
"*" => array("w" => 1, "d" => "Up")
),
";" => array(
":" => array("w" => 1, "d" => "Right"),
"," => array("w" => 1, "d" => "Left"),
"S" => array("w" => 1, "d" => "Down"),
"(" => array("w" => 1, "d" => "Up")
),
":" => array(
"'" => array("w" => 1, "d" => "Right"),
";" => array("w" => 1, "d" => "Left"),
"T" => array("w" => 1, "d" => "Down"),
")" => array("w" => 1, "d" => "Up")
),
"'" => array(
"\"" => array("w" => 1, "d" => "Right"),
":" => array("w" => 1, "d" => "Left"),
"U" => array("w" => 1, "d" => "Down"),
"?" => array("w" => 1, "d" => "Up")
),
"\"" => array(
"_" => array("w" => 1, "d" => "Right"),
"'" => array("w" => 1, "d" => "Left"),
"V" => array("w" => 1, "d" => "Down"),
"/" => array("w" => 1, "d" => "Up")
),
"_" => array(
"=" => array("w" => 1, "d" => "Right"),
"\"" => array("w" => 1, "d" => "Left"),
"W" => array("w" => 1, "d" => "Down"),
"|" => array("w" => 1, "d" => "Up")
),
"=" => array(
"BS" => array("w" => 1, "d" => "Right"),
"_" => array("w" => 1, "d" => "Left"),
"X" => array("w" => 1, "d" => "Down"),
"\\" => array("w" => 1, "d" => "Up")
),
"BS" => array(
"BS" => array("w" => 1, "d" => "Right"),
"=" => array("w" => 1, "d" => "Left"),
"Y" => array("w" => 1, "d" => "Down"),
"+" => array("w" => 1, "d" => "Up")
),
"BS" => array(
"BS" => array("w" => 1, "d" => "Left"),
"Z" => array("w" => 1, "d" => "Down"),
"-" => array("w" => 1, "d" => "Up")
),
);
} // end class