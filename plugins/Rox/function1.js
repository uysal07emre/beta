// JavaScript Document
text = new Array()
time = 2000 //zeit im millisekunden, Bsp: 2 sek

text[1] = "Live";
text[2] = "Login";
text[3] = "Loves you❤️";


document.getElementById('textinhalt').innerHTML=text[1];

function aenderText(x){

document.getElementById('textinhalt').innerHTML=text[x];

if(text[x+1]){
setTimeout("aenderText("+(x+1)+")",time);


}
else{ // Hier wird die Schleife wiederholt, notfalls einfach rauslöschen,
setTimeout("aenderText(1);",time); // also die 3 Zeilen
} // bis einschließlich hier.
}


setTimeout("aenderText(1);",time);