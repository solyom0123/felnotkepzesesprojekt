/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Naphozrendelt_Model {
    //osztalyvaltozok:
    //modul: a hozzarendelt tananyagegyseg modulja;
    //tananyagegyseg: a hozzarendelt tananyagegyseg;
    //tipus: a hozzarendelt tananyagegyseg elmeletet vagy gyakorlatat vagy vizsgat rendelte hozza
    //oraszam : a rogzitett oraszam;
    /**
     * 
     * @param {type} modul
     * @param {type} tananyagegyseg
     * @param {type} tipus
     * @param {type} oraszam
     * @param {type} vizsga
     * @returns {Naphozrendelt_Model}
     */
    constructor(modul, tananyagegyseg, tipus,oraszam,vizsga){
    this.modul=modul;
    this.tananyagegyseg=tananyagegyseg;
    this.tipus = tipus;
    this.oraszam = oraszam;
    this.vizsga = vizsga;
    
    }
    
    getTipus(){
        return this.tipus;
    }
    
    getModul(){
        return this.modul;
    }
    
    getTanegyseg(){
        return this.tananyagegyseg;
    }
    
    getoraszam(){
        return this.oraszam;
    }
    
    getvizsga(){
        return this.vizsga;
    }
    
}