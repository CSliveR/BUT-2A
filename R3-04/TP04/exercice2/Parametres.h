#ifndef PARAMETRES_H
#define PARAMETRES_H
#include <string>
#include "Theme.h"
#include "Joueur.h"

class Parametres {
    // à compléter
public:
    static Parametres& getInstance();
    Theme getTheme() const;
    void setTheme(const Theme &theme);
    const Joueur* getJoueur() const;
    void setJoueur(const Joueur *joueur);
    void afficher() const;
protected:
    Parametres();
    Parametres(const std::string &intituleTheme);
    ~Parametres() = default;
private:
    static Parametres *m_instance;
    Theme m_theme;
    const Joueur *m_joueur;
};

#endif /* PARAMETRES_H */
