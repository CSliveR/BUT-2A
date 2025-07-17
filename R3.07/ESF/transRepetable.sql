-- QUESTION 1-------------------------------------------------------------------
-- user1 fait des modifications validees, user2 des select
-- user1
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
-- user2
select * from COURS;
-- user1
insert into COURS values(12,'Le Centre',20,'26/12/2014','01/01/2015','14:30','16:30');
-- user2
select * from COURS;
-- user1
commit;
-- user2
select * from COURS;
-- RESULTAT : ???
/*Le 2ème utilisateur peut voir l'insertion d'un 12ème uplet par l'utilisateur 1 que si cet utilisateur a déjà confirmé avec "commit" le changement. Le 2ème utilisateur
ne peut pas voir le changement de l'utilisateur 1 lorsque qu'il est en train de le réaliser. Autrement dit, tant que le 1er utilisateur ne confirme pas sa modification, 
le 2ème utilisateur ne peut pas la voir.*/

-- QUESTION 2-------------------------------------------------------------------
-- user1 fait des modifications annulees, user2 des select
-- user1
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
-- user2
select * from COURS;
-- user1
insert into COURS values(13,'Le Centre',20,'01/01/2015','07/01/2015','14:30','16:30');
select * from COURS;
-- user2
select * from COURS;
-- user1
rollback;
-- user2
select * from COURS;
-- RESULTAT : ???

/*Cette situation est exactement la même que la précédente à la différence qu'ici, le 1er utilisateur n'a pas confirmé l'insertion d'un treizième uplet (que l'on peut 
voir quand cet utilisateur affiche la table "COURS"). L'utilisateur 2 ne verra jamais ce treizième uplet du début à la fin de la transaction.*/

-- QUESTION 3-------------------------------------------------------------------
-- user1 et user2 insèrent des moniteurs différents (intercaler les requetes)

--user 1--
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
insert into MONITEUR values(5,'Yonezu','Kenshi','Sapporo','0733101311');
--user 2--
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
insert into MONITEUR values(6,'Placette','Thierry','Grenoble','0788671002');
--user 1--
commit;
--user 2--
commit;
-- QU'OBSERVEZ-VOUS : ???

/*Les 2 insertions se passent normalement*/


-- QUESTION 4-------------------------------------------------------------------
-- user1 et user2 insèrent le meme moniteur (intercaler les requetes) Cas ou user1 valide sa transaction
--user 1
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
insert into MONITEUR values(7,'Beret','Jeff','Villeurbanne','0713688244');
--user 2
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
insert into MONITEUR values(7,'Beret','Jeff','Villeurbanne','0713688244');
--user 1
commit;
--user2
commit;

-- QU'OBSERVEZ-VOUS : ???
/*L'utilisateur 1 insére un moniteur et l'utilisateur 2 insére le même après mais obtient une erreur informant cet utilsateur que ce moniteur existe déjà dans la table
MONITEUR. La transaction de l'utilisateur 2 est donc annulée par le SGBD.*/

/*POV user2*/
drouichi=*>insert into MONITEUR values(7,'Beret','Jeff','Villeurbanne','0713688244');
ERROR:  duplicate key value violates unique constraint "moniteur_pkey"
DETAIL:  Key (nummono)=(7) already exists.
drouichi=!> commit;
ROLLBACK
drouichi=> 


-- user1 et user2 insèrent le meme moniteur (intercaler les requetes) Cas ou user1 annule sa transaction

--user 1
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
insert into MONITEUR values(8,'Nakama','Nakata','Tokyo','0937551074');
--user 2
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
insert into MONITEUR values(8,'Nakama','Nakata','Tokyo','0937551074');
--user 1
rollback;
--user2
commit;
-- QU'OBSERVEZ-VOUS : ???
/*J'observe que lorsque que le même uplet est inséré du côté de l'utilisateur 2, le SGBD ne déclenche pas une erreur mais attend ce que va faire l'utilisateur 1. Ici, 
l'utilisateur 1 fait un rollback et n'insère finalement pas le moniteur donc l'insertion se fait au niveau de l'utilisateur qui n'a pas décidé d'annuler son insertion.*/

-- QUESTION 5-------------------------------------------------------------------
-- user1 affecte les cours de JC Killy à Luc Alphand
--user2 les affecte a Marielle Goitschel 
--user1
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
--user2
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
--user1
update ENSEIGNE set nummono='2' where numcours=1;
--user2
update ENSEIGNE set nummono='4' where numcours = 11;
--user1
update ENSEIGNE set nummono='2' where numcours = 11;
--user2
update ENSEIGNE set nummono='4' where numcours=1;
-- QU'OBSERVEZ-VOUS ?
ERROR:  deadlock detected
DETAIL:  Process 3345613 waits for ShareLock on transaction 351877; blocked by process 3345591.
Process 3345591 waits for ShareLock on transaction 351878; blocked by process 3345613.
HINT:  See server log for query details.
CONTEXT:  while updating tuple (0,9) in relation "enseigne"
--user1
commit;
--user2
commit; 
-- QU'OBSERVEZ-VOUS : ???
PROBLEME: INTERBLOCAGE
/*Nous modifions dans un premier temps numcours = 1 puis numcours = 11. Ensuite, nous refaisons une modification de numcours = 11 qui est 
déjà pris pour nummono = '4', le SGBD attend que le nummono = '4' soit libéré pour pouvoir associé ('2',11) mais on associe ('4',1) qui
déjà pris par '2' donc les mises à jour s'attendent indéfiniment et le SGBD stoppe les processus en cours.*/


-- QUESTION 6-------------------------------------------------------------------
-- user1 lit les informations sur les cours du Centre, user2 les retarde
--user1
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
select * from COURS where lieurv= 'Le Centre';
--user2 
begin;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ ; 
update COURS set heurefin = heurefin + interval '1 hours', heuredeb = heuredeb + interval '1 hours' where lieurv = 'Le Centre';
--user1
select * from COURS where lieurv = 'Le Centre';
-- QU'OBSERVEZ-VOUS ?
/*Les informations du cours ne sont pas modifiés du point de vue du l'utilisateur 1.*/
--user2 
commit;
--user1
select * from COURS where lieurv = 'Le Centre';
-- QU'OBSERVEZ-VOUS : ???
/*Les informations du user 1 sont modifiées alors qu'il ne faisait que lire les informations.
commit;

-- QUEL PROBLEME APPARAIT ICI ? POURQUOI ?
