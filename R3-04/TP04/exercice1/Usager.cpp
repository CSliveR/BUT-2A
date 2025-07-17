#include "Usager.h"
using namespace std;
// à compléter
Usager::Usager(const string &login, const string &groupe):
m_login(login), m_groupe(groupe) {
}

const string &Usager::getLogin() const {
    return this->m_login;
}

const string &Usager::getGroupe() const {
    return this->m_groupe;
}