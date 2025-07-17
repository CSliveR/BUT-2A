#ifndef SALARIE_H
#define	SALARIE_H

#include <string>
#include <iostream>
#include "SalarieException.h"
#include "ObjetContraint.h"
#include <map>

class Salarie {
public:
    // A COMPLETER : Spécifier les méthodes d'instance d'un Salarie
    Salarie(const std::string &nom, const std::string &numeroSS, const ObjetContraint<float> &salaireMensuel);
    const std::string &getNom() const;
    void setNom(const std::string &nom);
    const std::string &getNumeroSS() const;
    void setNumeroSS(const std::string &numeroSS);
    float getSalaireMensuel() const;
    void setSalaireMensuel(float salaireMensuel);
    float getImpot() const;
    void saisir(std::istream &entree = std::cin);
    void afficher(std::ostream &sortie = std::cout) const;
    
    // Fourni : Constantes de Classe
    static const float                 SMIC;
    static const float                 COEFF_SMIC;
    static const std::string           NOM_DEF;
    static const std::string           NUMERO_SS_DEF;
    static const std::map<float,float> TRANCHES_IMPOT;

private:
    // A COMPLETER : déclarer les attributs d'instance d'un Salarie
    std::string m_nom;
    std::string m_numeroSS;
    ObjetContraint<float> m_salaireMensuel;
};

#endif	/* SALARIE_H */

