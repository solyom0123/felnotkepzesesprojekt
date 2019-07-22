/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Kepzes_Model {
    //osztalyvaltozok:
    //id: adatbazisban a kepzeshez tartozo id
    //kepzes_neve: az adatbazisban megadott kepzesi nev
    //modulok: a képzéshez kivalasztott beosztandó modulok
    constructor(id, kepzes_neve, kepzes_azonosito) {
        this.id = id;
        this.kepzes_neve = kepzes_neve;
        this.kepzes_azonosito = kepzes_azonosito;
        this.modulok = new Array();
    }
    getKepzes_neve() {
        return this.kepzes_neve;
    }
    getAzonosito() {
        return this.kepzes_azonosito;
    }

    getModulok() {
        return this.modulok;
    }
      getModul(int) {
        return this.modulok[int];
    }
    getId() {
        return this.id;
    }
    addModul(modul){
        this.modulok[this.modulok.length] = modul;
    }
    
  

}