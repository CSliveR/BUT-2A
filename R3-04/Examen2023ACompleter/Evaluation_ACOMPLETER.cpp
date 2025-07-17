// A COMPLETER

#include "Evaluation_ACOMPLETER.h"
#include <string>
#include <iostream>
#include <iomanip>
#include <stdexcept>

using namespace std;

Evaluation::Evaluation(const std::string &intitule): m_intitule(intitule) {
}

Evaluation::~Evaluation() {
}

const std::string & Evaluation::getIntitule() const {
    return this->m_intitule;
}

void Evaluation::setIntitule(const std::string &intitule) {
    this->m_intitule = intitule;
}

void Evaluation::affiche() const {
    cout << "Evaluation : " << this->getIntitule() << " Coefficient : " << this->getCoefficient() << " Note : " << this->getNote();

}
