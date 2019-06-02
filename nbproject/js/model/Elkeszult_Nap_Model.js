/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Elkeszult_Nap_Model {
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
   
            
    ){

    this.hetnapja = hetnapja;
    this.datum = datum;
    this.tartaleknap= tartaleknap;
    this.felhasznalt_elmelet =0;
    this.felhasznalt_gyakorlat=0;
    this.hozzarendeltek = new Array();
    }
    
    getFelhasznalt_elmelet(){
        return this.felhasznalt_elmelet;
    }
    
    getFelhasznalt_gyakorlat(){
        return this.felhasznalt_gyakorlat;
    }
    setFelhasznalt_elmelet(felhasz){
        this.felhasznalt_elmelet=felhasz;
    }
    
    setFelhasznalt_gyakorlat(felhasz){
        this.felhasznalt_gyakorlat=felhasz;
    }
    
    getdatum(){
        return this.datum;
    }
    
    getNap(){
        return this.hetnapja;
    }
    gettartaleknap(){
        return this.tartaleknap;
    }
    
    settartaleknap(tartalek){
        this.tartaleknap=tartalek;
    }
    
    gethozzarendeltek(){
        return this.hozzarendeltek;
    }
    
}