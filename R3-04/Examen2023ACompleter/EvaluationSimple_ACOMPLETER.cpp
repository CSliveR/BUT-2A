// A COMPLETER

#include "EvaluationSimple_ACOMPLETER.h"
#include <stdexcept>
using namespace std;

EvaluationSimple::EvaluationSimple(const std::string &intitule, unsigned int coefficient):
Evaluation(intitule),m_coefficient(coefficient), m_note(nullptr) {
}

unsigned int EvaluationSimple::getCoefficient() const {
    return this->m_coefficient;
}

void EvaluationSimple::setCoefficient(unsigned int coefficient) {
    this->m_coefficient = coefficient;
}

float EvaluationSimple::getNote() const {
    if(this->m_note == nullptr) {
        throw range_error("No more note");
    }
    return *this->m_note;
}

void EvaluationSimple::setNote(float note) {
    try {
        m_note = new ObjetContraint<float>(note, 0.0f,20.0f);
    }catch(const range_error&) {
        throw range_error("No more note");
    }
}

void EvaluationSimple::addEvaluation(const Evaluation &evaluation) {
    throw logic_error("Cannot add Evaluation");
}
