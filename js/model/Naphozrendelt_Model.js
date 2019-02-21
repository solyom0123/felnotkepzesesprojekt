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
    //tipus: a hozzarendelt tananyagegyseg elmeletet vagy gyakorlatat rendelte hozza
    
    constructor(modul, tananyagegyseg, tipus
    ){
    this.modul=modul;
    this.tananyagegyseg=tananyagegyseg;
    this.tipus = tipus
    }
    
    getTipus(){
        return this.tipus;
    }
    
    getModul(){
        return this.modul;
    }
    
    getTanegyseg(){
        return this.tanegyseg;
    }
    
}