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


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Vizsga_Model {
    //osztalyvaltozok:
    //tipus: milyen tipusu vizsga
    //szamitott_oraszam: az adatbazisban megadott a napra megengedett oraszamok elmeletbol
    //engedett_gyakorlati_ora: az adatbazisban megadott a napra megengedett oraszamok gyakorlatbol
    
    /**
     * 
     * @param {type} tipus
     * @param {type} szamitott_oraszam
     * @returns {Vizsga_Model}
     */
    constructor(tipus,
    szamitott_oraszam,
    ){
    this.tipus=tipus; 
    this.szamitott_oraszam=szamitott_oraszam ;
    this.felhasznalt=false;
    }
    
    getTipus(){
        return this.tipus;
    }
    
    getSzamitott_oraszam(){
        return this.szamitott_oraszam;
    }
    getFelhasznalt(){
        return this.felhasznalt;
    }
    setFelhasznalt(fel){
        this.felhasznalt=fel;
    }
}