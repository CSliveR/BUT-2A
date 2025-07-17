#ifndef USAGER_H
#define USAGER_H
#include <string>

class Usager {
    // à compléter
public:
    Usager(const std::string &login, const std::string &groupe);
    const std::string &getLogin() const;
    const std::string &getGroupe() const;
private:
    std::string m_login; //Login d'un Usager.
    std::string m_groupe; //Groupe auquel l'Usager appartient.
};

#endif /* USAGER_H */

