/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Utemterv_bejegyzes_Model {
    //osztalyvaltozok:
    //het_napja:  nap  object
    
//    datum: naptari_datum
//    tartaleknap: tartaleknapnak hasznalhato vagy sem
//    felhasznalt_elmelet: mar hozzarendelt tananyagegysegek oraszama osszesen elmeletbol
//    felhasznalt_gyakorlat: mar hozzarendelt tananyagegysegek oraszama osszesen gyakorlatbol
//    hozzarendeltek: a mar hozzarendelt modul es tananyagegyseg adata;    
    /**
     * 
     * @param {type} hetnapja
     * @param {type} datum
     * @param {type} tartaleknap
     * @returns {Elkeszult_Nap_Model}
     */
    constructor(
    hetnapja,   //
    datum,      //0
    tartaleknap,//1
    tanegysegId,//2
    oraszam,    //3
    tipus,      //4
    vizsga,     //5
    start,      //6
    end,        //7
    modul       //8 
    ){
    this.oktato ="senki";
    this.hetnapja = hetnapja;
    this.datum = datum;
    this.tartaleknap= tartaleknap;
    this.tanegysegVagyVizsgaid = tanegysegId;
    this.oraszam =oraszam;
    this.start =start;
    this.end = end;
     this.vizsga = vizsga;
    this.tipus=tipus;
    this.modul =modul;
    }
    
    getOra(){
        return this.oraszam;
    }
    setOra(ora){
       this.oraszam=ora;
    }
    getTanegysegVizsgaid(){
        return this.tanegysegVagyVizsgaid;
    }
    getdatum(){
        return this.datum;
    }
    
    getNap(){
        return this.hetnapja;
    }
    getTipus(){
        return this.tipus;
    }
    setTipus(tipus){
       this.tipus=tipus;
    }
    isVizsga(){
        return this.vizsga;
    }
    getOktato(){
        return this.oktato;
    }
    getModul(){
        return this.modul;
    }
    setModul(id){
        this.modul=id;
        
    }
    setOktato(oktato){
        this.oktato=oktato;
    }
    setTanegyseg(id){
     this.tanegysegVagyVizsgaid=id;   
    }
    getKezd(){
        return this.start;
    }
    setKezd(ora){
        this.start=ora;
    }
    
    getVeg(){
        return this.end;
    }
    
    setVeg(ora){
       this.end=ora;
    }
    isTartalekNap(){
        return this.tartaleknap;
    }
}