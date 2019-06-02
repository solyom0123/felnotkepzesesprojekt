/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Oktatok_Model {
    //osztalyvaltozok:
    //id: az oktato adatbazis beli id-ja;
    //neve: az oktato neve;
    /**
     * 
     * @param {type} id
     * @param {type} neve
     * @returns {Oktatok_Model}
     */
    constructor(id, neve
    ){
    this.id=id;
    this.neve=neve;
    }
    
    getId(){
        return this.id;
    }
    
    getNeve(){
        return this.neve;
    }
    
    
}
