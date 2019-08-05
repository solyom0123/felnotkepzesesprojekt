/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class Modul_Model {
    //osztalyvaltozok:
    //id: adatbazisban a modulhoz tartozo id
    //modul_neve: az adatbazisban modul neve
    //tananyagegysegek: a modulhoz kapcsolódó tananyagegysegek
    //elmeleti_oraszam:  az adatbazisban megadott adatok
    //gyakorlati_oraszam: az adatbazisban megadott adatok;
    //vizsgak : a modulhoz tartozo vizsgak;
    /**
     * 
     * @param {type} id
     * @param {type} modul_neve
     * @param {type} elmeleti_oraszam
     * @param {type} gyakorlati_oraszam
     * @param {type} sorrend
     * @returns {Modul_Model}
     */
    constructor(id,
    modul_neve,
    modul_azon,
    elmeleti_oraszam,
    gyakorlati_oraszam,
    ){
    this.id=id; 
    this.modul_neve=modul_neve;
    this.modul_azon = modul_azon;
    this.tananyagegysegek = new Array();
    this.elmeleti_oraszam =elmeleti_oraszam;
    this.gyakorlati_oraszam = gyakorlati_oraszam;
    this.felhasznalt_elmeleti_oraszam =0;
    this.felhasznalt_gyakorlati_oraszam =0;
    this.vizsgak =new Array();
    this.vizsgakraFennmaradóÓraszám = 0;
    }
    getModul_neve(){
        return this.modul_neve;
    }
    getModul_azon(){
        return this.modul_azon;
    }
    getTananyagegysegek(){
        return this.tananyagegysegek;
    }
    addTananyagegyseg(tanegyseg){
         this.tananyagegysegek[this.tananyagegysegek.length]=tanegyseg ;
    }
    getVizsgak(){
        return this.vizsgak;
    }
     getVizsga(int){
        return this.vizsgak[int];
    }
    getElmeleti_oraszam(){
        return this.elmeleti_oraszam;
    }
    setFelhasznaltElmeletiOraszam(ora){
        this.felhasznalt_elmeleti_oraszam=ora;
    }
    
    getFelhasznaltElmeletiOraszam(){
        return this.felhasznalt_elmeleti_oraszam;
    }
    setFelhasznaltGyakorlatiOraszam(ora){
        this.felhasznalt_gyakorlati_oraszam=ora;
    }
    
    getFelhasznaltGyakorlatiOraszam(){
        return this.felhasznalt_gyakorlati_oraszam;
    }
    getKifogogyott(){
        return false;
    }
    getTanegyseg(int) {
        return this.tananyagegysegek[int];
    }
    getGyakorlati_oraszam(){
        return this.gyakorlati_oraszam;
    }
    getId(){
        return this.id;
    }
    addVizsga(vizsga){
      this.vizsgak[this.vizsgak.length] = vizsga;  
    }
   
}