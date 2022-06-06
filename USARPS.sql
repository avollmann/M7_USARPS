create table player
(
    pk_playerID integer auto_increment,
    username    varchar(50) unique,
    primary key (pk_playerID)
);

create table game
(
    pk_gameID     integer auto_increment,
    fk_userID1    integer,
    fk_handValue1 integer,
    fk_userID2    integer,
    fk_handValue2 integer,
    datum date,
    zeit time,
    primary key (pk_gameID)
);

create table hand
(
    pk_handID integer primary key,
    hand      varchar(50)
);

insert into hand
values (1, 'Rock');
insert into hand
values (2, 'Paper');
insert into hand
values (3, 'Scissor');

insert into player(username)
values ('Domi');
insert into player(username)
values ('Alex');
insert into player(username)
values ('Nici');

insert into game(fk_userID1, fk_handValue1, fk_userID2, fk_handValue2, datum, zeit)
values (1, 1, 2, 2, '2022-05-31', '02:01');
insert into game(fk_userID1, fk_handValue1, fk_userID2, fk_handValue2, datum, zeit)
values (1, 1, 2, 3, '2022-05-31', '02:01');
insert into game(fk_userID1, fk_handValue1, fk_userID2, fk_handValue2, datum, zeit)
values (1, 1, 3, 3, '2022-05-31', '02:01');
insert into game(fk_userID1, fk_handValue1, fk_userID2, fk_handValue2, datum, zeit)
values (1, 1, 3, 2, '2022-05-31', '02:01');
insert into game(fk_userID1, fk_handValue1, fk_userID2, fk_handValue2, datum, zeit)
values (2, 2, 3, 3, '2022-05-31', '02:01');
insert into game(fk_userID1, fk_handValue1, fk_userID2, fk_handValue2, datum, zeit)
values (2, 1, 3, 2, '2022-05-31', '02:01');


alter table game add constraint c1 foreign key (fk_userID1) references player(pk_playerID);
alter table game add constraint c2 foreign key (fk_userID2) references player(pk_playerID);
alter table game add constraint c3 foreign key (fk_handValue1) references hand(pk_handID);
alter table game add constraint c4 foreign key (fk_handValue2) references hand(pk_handID);


select pk_gameID gameID, p.username user1, h1.hand hand1, p2.username user2, h2.hand hand2, datum, zeit
from game
         join player p on game.fk_userID1 = p.pk_playerID
         join player p2 on game.fk_userID2 = p2.pk_playerID
         join hand h1 on game.fk_handValue1 = h1.pk_handID
         join hand h2 on game.fk_handValue2 = h2.pk_handID
order by pk_gameID;