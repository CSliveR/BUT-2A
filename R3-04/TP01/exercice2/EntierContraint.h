#ifndef ENTIERCONTRAINT_H
#define ENTIERCONTRAINT_H

#include <iostream>
#include <limits>

class EntierContraint {
public:
    // A COMPLETER
    EntierContraint();
    EntierContraint(int valeur, int min, int max);
    int getMin() const;
    int getMax() const;
    int getVal() const;
    void setVal(int valeur);
    void saisir(std::istream &istream);
    void afficher(std::ostream &ostream) const;
private:
    // A COMPLETER
    int m_min;
    int m_max;
    int m_val;

    // Constantes de Classe (static) pour définir les valeurs par défaut des attributs d'un entier contraint
    static constexpr int VAL_DEF = 0;
    static constexpr int MIN_DEF = std::numeric_limits<int>::min(); // le plus petit int possible
    static constexpr int MAX_DEF = std::numeric_limits<int>::max(); // le plus grand int possible
};

#endif /* ENTIERCONTRAINT_H */

