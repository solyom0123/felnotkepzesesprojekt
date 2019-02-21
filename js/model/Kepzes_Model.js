/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Kepzes_Model {
    //osztalyvaltozok:
    //id: adatbazisban a kepzeshez tartozo id
    //kepzes_neve: az adatbazisban megadott kepzesi nev
    //modulok: a képzéshez kapcsolódó modulok
    constructor(id, kepzes_neve) {
        this.id = id;
        this.kepzes_neve = kepzes_neve;
        this.modulok = new Array();
    }
    getKepzes_neve() {
        return this.kepzes_neve;
    }

    getModulok() {
        return this.modulok;
    }
    getId() {
        return this.id;
    }

}