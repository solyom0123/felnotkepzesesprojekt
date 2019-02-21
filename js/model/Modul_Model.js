/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class Modul_Model {
    //osztalyvaltozok:
    //id: adatbazisban a kepzeshez tartozo id
    //modul_neve: az adatbazisban megadott kepzesi nev
    //tananyagegysegek: a képzéshez kapcsolódó tananyagegysegek
    //elmeleti_oraszam:  az adatbazisban megadott adatok
    //gyakorlati_oraszam: az adatbazisban megadott adatok;
    //vizsgak : a modulhoz tartozo vizsgak;
    // sorrend: hanyadik a modul a tervezesi sorrendben
    constructor(id,
    modul_neve,
    elmeleti_oraszam,
    gyakorlati_oraszam
    ){
    this.id=id; 
    this.modul_neve=modul_neve;
    this.tananyagegysegek = new Array();
    this.elmeleti_oraszam =elmeleti_oraszam;
    this.gyakorlati_oraszam = gyakorlati_oraszam;
    this.vizsgak =new Array();
    this.sorrend ;
    }
    getModul_neve(){
        return this.modul_neve;
    }
    
    getTananyagegysegek(){
        return this.tananyagegysegek;
    }
    
    getVizsgak(){
        return this.vizsgak;
    }
    getElmeleti_oraszam(){
        return this.elmeleti_oraszam;
    }
    getKifogogyott(){
        return false;
    }
    getGyakorlati_oraszam(){
        return this.gyakorlati_oraszam;
    }
    getId(){
        return this.id;
    }
    
}