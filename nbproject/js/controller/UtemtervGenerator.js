/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 
 /*
  * Utemterv tervezett lepesei:
  * 
  * 1.felvisz aktiv kepzes alapadatai
  * 2.letrehoz aktiv kepzes object
  * 3.leker szunetek es unnepnapok es eltarol elkeszult nap szerkezetben es hozzaad aktiv kepzes object kizartnapok tombhoz.
  * 4.1.lekér választott képzés nevét
  * 5. létrehoz képzés object
  * 6.lekér válaszott képzéshez tartozó modulok adatait
  * 7. létrehoz modul object es megmondja hogy hanyadik a sorrendben az id alapjan
  * 8. lekér adott modul tananyagegységeit
  * 9. létrehoz tananyagegyseg object hozzaad modul egyseg tombjehez
  * 10. leker adott tanegyseg okatainak adatai
  * 11. letrehoz oktatok object hozzaad tanegyseg tombjehez
  * 12. modul object hozzaad kepzes object tombjehez
  * 13.hozzaad aktiv kepzes objecthez kepzes object
  * 14.letrehoz nap objectek és hozzaad aktiv kepzes objecthez
  * 15.legeneral osszes elkeszult nap object kezdesi datumtol jelentkezesi napig csak datummal es engedett oraszammal es hogy tartaleknap vagy sem, tartalek napot csak megadott szambahoz letre , ami nincs aktiv kepzes kizart napok tombben
  * 16.megkeresi elso modult a sorrendbe, az elso elkeszult napot , a modulba megkeresi azt a tananyagegseget, ami az adott tipusu oraszammal egyenlo vagy kisebb es nem felhasznalt , az elkeszult nap nem lehet tartalek nap,
  * 17.letrehoz egy naphozrendelt object atallit tanegyseg object felhasznalt elmelet boolean valtozojat.hozzaadja az adott elkeszult nap objecthez a naphozrendelt objectet.
  * 18.ha van felhasznalhato ora megkeresei az adott modulban az adott tipusu oraszamokkal rendelkezo tanegysegek kozul azt amelyik kisebb vagy egyenlo es nem felhasznalt es megismetli a 17.lepest 
  * 19.ha nem talal a felteleknek megfelelo tanegyseget az adott modulban tovabb megy a kovetkezo modulba es ott ismetli a 16.17.18 lepeseket amig el nem fogy az adott elkeszult nap object oraszama
  * 20.megvizsgalja hogy az adott modul osszes tanegysege fel lett e hasznalva, ha igen az adott elkeszult nap objecthez hozzadja a vizsgat, abbol a tipusu oraszambol ami elfogyott, ha van meg elegendo oraszam, ha nincs akkor a kovetkezo elkeszult naphoz. 
  * 21. ezt ismetli amig vegig er az elkeszult napokon vagy el nem fogy az osszes modul osszes tanegysege.
  * 22. megvizsgalja, hogy elfogyott az osszes modul, ha nem akkor elorol kezdi a 16. lepesttol a tartaleknapok hasznalataval.
  * 23. megviszgalja, hogy elfogyott az osszes modul, ha nem akkor kilistazza az utem terv mellett a fel nem hasznalt tanegysegeket. es kiszamolja hany tartalek nap kellene meg.
  */