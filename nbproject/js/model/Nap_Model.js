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


class Nap_Model {
    //osztalyvaltozok:
    //sorszam: a het melyik napja
    //engedett_elmeleti_ora: az adatbazisban megadott a napra megengedett oraszamok elmeletbol
    //engedett_gyakorlati_ora: az adatbazisban megadott a napra megengedett oraszamok gyakorlatbol
    
    /**
     * 
     * @param {type} sorszam
     * @param {type} engedett_elmeleti_ora
     * @param {type} engedett_gyakorlati_ora
     * @returns {Nap_Model}
     */
    constructor(sorszam,
    engedett_elmeleti_ora,
    engedett_gyakorlati_ora
    ){
    this.sorszam=sorszam; 
    this.engedett_elmeleti_ora =engedett_elmeleti_ora;
    this.engedett_gyakorlati_ora = engedett_gyakorlati_ora;
    }
    
    getEngedett_Elmeleti_oraszam(){
        return this.engedett_elmeleti_ora;
    }
    
    getEngedett_Gyakorlati_oraszam(){
        return this.engedett_gyakorlati_ora;
    }
    getSorszam(){
        return this.sorszam;
    }
    
}