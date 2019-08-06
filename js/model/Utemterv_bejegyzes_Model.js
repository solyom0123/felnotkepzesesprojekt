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
    constructor(hetnapja,
    datum,
    tartaleknap,
    tanegysegId,
    oraszam, 
    tipus,
    
    
    vizsga,
    start, 
    end,
    modul        
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
    getVizsga(){
        return this.vizsga;
    }
    getOktato(){
        return this.oktato;
    }
    getModul(){
        return this.modul;
    }
    setOktato(oktato){
        this.oktato=oktato;
    }
    getKezd(){
        return this.start;
    }
    getVeg(){
        return this.end;
    }
}