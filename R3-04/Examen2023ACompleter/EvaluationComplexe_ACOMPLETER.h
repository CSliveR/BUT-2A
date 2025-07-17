#ifndef EXAMEN2023C_EVALUATIONCOMPLEXE_H
#define EXAMEN2023C_EVALUATIONCOMPLEXE_H

// A COMPLETER

#include <string>
#include <vector>
#include "Evaluation_ACOMPLETER.h"

class EvaluationComplexe : public Evaluation {
public:
    EvaluationComplexe(const std::string &intitule);
    ~EvaluationComplexe() override = default;
    unsigned int getCoefficient() const override;
    void setCoefficient(unsigned int coefficient) override;
    float getNote() const override;
    void setNote(float note) override;
    void addEvaluation(const Evaluation &evaluation) override;
private:
    std::vector<const Evaluation*> m_evaluations;
};


#endif //EXAMEN2023C_EVALUATIONCOMPLEXE_H
