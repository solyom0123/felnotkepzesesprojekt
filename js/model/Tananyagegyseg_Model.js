/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Tananyagegyseg_Model {
    //osztalyvaltozok:
    //id: adatbazisban a tanegyseghez tartozo id
    //tanegyseg_neve: az adatbazisban megadott tanegyseg nev
    //elmeleti_oraszam:  az adatbazisban megadott adatok
    //gyakorlati_oraszam: az adatbazisban megadott adatok;
   // felhasznalt_elmelet: hozzarendeltuk-e mar egy naphoz az elmeletet vagy sem
   // felhasznalt_gyakorlat: hozzarendeltuk-e mar egy naphoz az gyakorlatot vagy sem 
   //oktatok: a tananyagot oktathato oktatok
    /**
     * 
     * @param {type} id
     * @param {type} tanegyseg_neve
     * @param {type} elmeleti_oraszam
     * @param {type} gyakorlati_oraszam
     * @returns {Tananyagegyseg_Model}
     */
    constructor(id,
    tanegyseg_neve,
    elmeleti_oraszam,
    gyakorlati_oraszam,
    elearn_oraszam,
    modulid        
    ){
    this.id=id; 
    this.tanegyseg_neve=tanegyseg_neve;
    this.elmeleti_oraszam =elmeleti_oraszam;
    this.gyakorlati_oraszam = gyakorlati_oraszam;
    this.elearn_oraszam = elearn_oraszam;
    
    this.felhasznalt_elmelet=0;
    this.felhasznalt_elearn=0;
    this.felhasznalt_gyakorlat=0;
    this.oktatok = new Array();
    this.modulid = modulid;
    }
    getMegmaradtElmelet(){
        return this.elmeleti_oraszam-this.felhasznalt_elmelet;
    }
    
    getMegmaradtGyakorlat(){
        return this.gyakorlati_oraszam-this.felhasznalt_gyakorlat;
    }
    getTanegyseg_neve(){
        return this.tanegyseg_neve;
    }
    
    getElmeleti_oraszam(){
        return this.elmeleti_oraszam;
    }
    
    getElearn_oraszam(){
        return this.elearn_oraszam;
    }
    getFelhasznalt_elmelet(){
        return this.felhasznalt_elmelet;
    }
    getFelhasznalt_elearn(){
        return this.felhasznalt_elearn;
    }
    getOktatok(){
        return this.oktatok;
        
    }
    getModulid(){
        return this.modulid;
    }
    getFelhasznalt_gyakorlat(){
        return this.felhasznalt_gyakorlat;
    }
    
    setFelhasznalt_elmelet(felhasznalt){
       this.felhasznalt_elmelet= felhasznalt;
    }
    setFelhasznalt_elearn(felhasznalt){
       this.felhasznalt_elearn= felhasznalt;
    }
    setFelhasznalt_gyakorlat(felhasznalt){
        this.felhasznalt_gyakorlat= felhasznalt;
    }
    getGyakorlati_oraszam(){
        return this.gyakorlati_oraszam;
    }
    getId(){
        return this.id;
    }
    
}