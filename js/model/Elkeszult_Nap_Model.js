/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Elkeszult_Nap_Model {
    //osztalyvaltozok:
    //het_napja: hanyadik nap a heten
    //sorszam: a rendezesbe a sorszam
//    datum: naptari_datum
//    tartaleknap: tartaleknapnak hasznalhato vagy sem
//    osszesenengedett_elmelet: mennyi elmeleti ora tarthato rajta
//    osszesenengedett_gyakorlat: mennyi gyakorlati ora tarthato rajta
//    felhasznalt_elmelet: mar hozzarendelt tananyagegysegek oraszama osszesen elmeletbol
//    felhasznalt_gyakorlat: mar hozzarendelt tananyagegysegek oraszama osszesen gyakorlatbol
//    hozzarendeltek: a mar hozzarendelt modul es tananyagegyseg adata;    
    constructor(hetnapja,sorszam,
    datum,
    tartaleknap,
    osszesenengedett_elmelet,
    osszesenengedett_gyakorlat,
    felhasznalt_elmelet,
    felhasznalt_gyakorlat
            
    ){

    this.hetnapja = hetnapja;
    this.sorszam = sorszam;
    this.datum = datum;
    this.tartaleknap= tartaleknap;
    this.osszesenengedett_elmelet =osszesenengedett_elmelet;
    this.osszesenengedett_gyakorlat =osszesenengedett_gyakorlat;
    this.felhasznalt_elmelet =felhasznalt_elmelet;
    this.felhasznalt_gyakorlat=felhasznalt_gyakorlat;
    this.hozzarendeltek = new Array();
    }
    
    getTipus(){
        return this.tipus;
    }
    
    getSzamitott_oraszam(){
        return this.szamitott_oraszam;
    }
    
}