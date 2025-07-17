#ifndef ELEMENT_H
#define ELEMENT_H
#include <string>
#include "Usager.h"
class Element {
  // à compléter
public:
  Element(const std::string &nom, const Usager &proprietaire, const std::string& dateModification);
  virtual ~Element() = default;
  const std::string& getNom() const;
  void setNom(const std::string &nom);
  const Usager& getPropretaire() const;
  void setPropretaire(const Usager &proprietaire);
  virtual unsigned int getTaille() const = 0;
  virtual const std::string& getDateModification() const;
  void setDateModification(const std::string &dateModification);
  virtual void afficher() const = 0;
  virtual void ajouter(Element *element) = 0;
private:
  std::string m_nom; //Nom d'un Element.
  Usager m_proprietaire; //Propriétaire de l'Element.
  std::string m_dateModification;
};

#endif /* ELEMENT_H */

