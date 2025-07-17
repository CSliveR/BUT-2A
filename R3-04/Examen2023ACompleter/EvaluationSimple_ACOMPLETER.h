// A COMPLETER

#ifndef EXAMEN2023C_EVALUATIONSIMPLE_H
#define EXAMEN2023C_EVALUATIONSIMPLE_H
#include <string>
#include "ObjetContraint.h"
#include "Evaluation_ACOMPLETER.h"

class EvaluationSimple : public Evaluation {
public:
    EvaluationSimple(const std::string &intitule, unsigned int coefficient);
    ~EvaluationSimple() override = default;
    unsigned int getCoefficient() const override;
    void setCoefficient(unsigned int coefficient) override;
    float getNote() const override;
    void setNote(float note) override;
    void addEvaluation(const Evaluation &evaluation) override;
private:
    const ObjetContraint<float> *m_note;
    unsigned int m_coefficient;

};

#endif //EXAMEN2023C_EVALUATIONSIMPLE_H
