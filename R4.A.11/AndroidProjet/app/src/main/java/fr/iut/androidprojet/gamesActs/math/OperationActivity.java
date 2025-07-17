package fr.iut.androidprojet.gamesActs.math;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.NumberPicker;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;
import java.util.Random;

import fr.iut.androidprojet.MotherActivity;
import fr.iut.androidprojet.R;
import fr.iut.androidprojet.gamesModels.math.Addition;
import fr.iut.androidprojet.gamesModels.math.Division;
import fr.iut.androidprojet.gamesModels.math.Multiplication;
import fr.iut.androidprojet.gamesModels.math.Operation;

import fr.iut.androidprojet.gamesModels.math.OperationsManager;
import fr.iut.androidprojet.gamesModels.math.Subtraction;

public class OperationActivity extends MotherActivity {
    private Button validerBtn;
    private String operation;
    private String level;
    private boolean estMelange;
    private OperationsManager<Operation> operationsManager;
    private Random random;
    private int multTableNumber;
    public static final String NOMBRE_ERREURS = "nbErreurs";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_operation);

        Intent intentFromMathActivity = getIntent();
        operation = intentFromMathActivity.getStringExtra("operation");
        level = intentFromMathActivity.getStringExtra("level");
        estMelange = intentFromMathActivity.getBooleanExtra("melange", false);
        multTableNumber = intentFromMathActivity.getIntExtra("pickedNumber", 1);

        validerBtn = findViewById(R.id.button_valider);

        operationsManager = new OperationsManager<>(new ArrayList<>(), estMelange);
        random = new Random();

        switch (operation) {
            case "Addition":
                operationsManager = generateAdditionOperations(level, random, estMelange);
                break;
            case "Soustraction":
                operationsManager = generateSubtractionOperations(level, random);
                break;
            case "Multiplication":
                operationsManager = generateMultiplicationOperations(level, random, estMelange);
                break;
            case "Division":
                operationsManager = generateDivisionOperations(level, random);
                break;
        }

        // Remplissage du LinearLayout avec les vues des opérations
        LinearLayout linearContainer = findViewById(R.id.linear_container);

        for (Operation operation : operationsManager.getOperations()) {
            // Création du layout pour chaque opération
            LinearLayout linearTMP = (LinearLayout) getLayoutInflater().inflate(R.layout.template_calcul, null);

            TextView calcul = linearTMP.findViewById(R.id.template_calcul);
            calcul.setText(operation.toString());

            if (operation instanceof Division) {
                Division division = (Division) operation;
                if(level.compareTo("Niveau 1") == 0) {
                    linearTMP.findViewById(R.id.template_reste_picker).setVisibility(View.GONE);
                    linearTMP.findViewById(R.id.template_reste_input).setVisibility(View.GONE);
                }else if(level.compareTo("Niveau 2") == 0) {
                    NumberPicker restePicker = linearTMP.findViewById(R.id.template_reste_picker);
                    restePicker.setVisibility(View.VISIBLE);
                    restePicker.setMinValue(0); restePicker.setMaxValue(division.getTerme2()- 1);
                }else {
                    EditText resteInput = linearTMP.findViewById(R.id.template_reste_input);
                    resteInput.setVisibility(View.VISIBLE);
                }
            }
            // Ajout du layout à la vue principale
            linearContainer.addView(linearTMP);
        }

        validerBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                for (int i = 0; i < linearContainer.getChildCount(); i++) {
                    View view = linearContainer.getChildAt(i);
                    EditText resultat = view.findViewById(R.id.template_resultat);
                    String resultatStr = resultat.getText().toString();
                    Operation op = operationsManager.getOperations().get(i);

                    if (!resultatStr.isEmpty()) {
                        op.setReponseUtilisateur(Integer.parseInt(resultatStr));
                    } else {
                        op.setReponseUtilisateur(null);
                    }

                    if (op instanceof Division) {
                        Division division = (Division) op;

                        if(level.compareTo("Niveau 1") == 0){
                            division.setResteUtilisateur(0);
                        }else if(level.compareTo("Niveau 2") == 0){
                            NumberPicker restePicker = view.findViewById(R.id.template_reste_picker);
                            division.setResteUtilisateur(restePicker.getValue());
                        }else{
                            EditText resteInput = view.findViewById(R.id.template_reste_input);
                            String resteStr = resteInput.getText().toString();
                            if (!resteStr.isEmpty()) {
                                division.setResteUtilisateur(Integer.parseInt(resteStr));
                            }
                        }
                    }
                }

                Intent endGameActivityIntent;
                if (operationsManager.getNombreReponsesJustes() == operationsManager.getNombreOperations()) {
                    endGameActivityIntent = new Intent(OperationActivity.this, FelicitationActivity.class);
                    startActivity(endGameActivityIntent);
                    finish();
                } else {
                    endGameActivityIntent = new Intent(OperationActivity.this, ErreurActivity.class);
                    int nbErreurs = operationsManager.getNombreOperations() - operationsManager.getNombreReponsesJustes();
                    endGameActivityIntent.putExtra(OperationActivity.NOMBRE_ERREURS, nbErreurs);
                    startActivity(endGameActivityIntent);
                }

                SharedPreferences sharedPreferences = getSharedPreferences("GameStats", MODE_PRIVATE);
                SharedPreferences.Editor editor = sharedPreferences.edit();

                switch (operation) {
                    case "Addition":
                        editor.putInt("SCORE_ADDITION", operationsManager.getNombreReponsesJustes());
                        break;
                    case "Soustraction":
                        editor.putInt("SCORE_SOUSTRACTION", operationsManager.getNombreReponsesJustes());
                        break;
                    case "Multiplication":
                        editor.putInt("SCORE_MULTIPLICATION", operationsManager.getNombreReponsesJustes());
                        break;
                    case "Division":
                        editor.putInt("SCORE_DIVISION", operationsManager.getNombreReponsesJustes());
                        break;
                }
                editor.apply();


            }
        });
    }

    private OperationsManager<Operation> generateAdditionOperations(String level, Random random, boolean estMelange) {
        List<Operation> additions = new ArrayList<>();
        for (int i = 1; i < 11; i++) {
            if (level.compareTo("Niveau 1") == 0) {
                additions.add(new Addition(i, i));
            } else if (level.compareTo("Niveau 2") == 0) {
                additions.add(new Addition(random.nextInt(i), random.nextInt(i)));
            } else {
                additions.add(new Addition(random.nextInt(100), random.nextInt(100)));
            }
        }
        return new OperationsManager<>(additions, estMelange);
    }

    private OperationsManager<Operation> generateSubtractionOperations(String level, Random random) {
        List<Operation> subtractions = new ArrayList<>();
        for (int i = 1; i < 11; i++) {
            if (level.compareTo("Niveau 1") == 0) {
                int terme1 = random.nextInt(i);
                int terme2 = random.nextInt(i);
                subtractions.add(new Subtraction(Math.max(terme1, terme2), Math.min(terme1, terme2)));
            } else if (level.compareTo("Niveau 2") == 0) {
                subtractions.add(new Subtraction(random.nextInt(i), random.nextInt(i)));
            } else {
                subtractions.add(new Subtraction(random.nextInt(200) - 100, random.nextInt(200) - 100));
            }
        }
        return new OperationsManager<>(subtractions, false);
    }

    private OperationsManager<Operation> generateMultiplicationOperations(String level, Random random, boolean estMelange) {
        List<Operation> multiplications = new ArrayList<>();
        for (int i = 1; i < 11; i++) {
            if (level.equals("Niveau 1")) {
                multiplications.add(new Multiplication(multTableNumber, i)); // Multiplication des doubles
            } else if (level.equals("Niveau 2")) {
                multiplications.add(new Multiplication(random.nextInt(10), random.nextInt(10)));
            } else {
                multiplications.add(new Multiplication(random.nextInt(100), random.nextInt(100)));
            }
        }
        return new OperationsManager<>(multiplications, estMelange);
    }

    private OperationsManager<Operation> generateDivisionOperations(String level, Random random) {
        List<Operation> divisions = new ArrayList<>();
        int terme1, terme2;
        Division division;

        for (int i = 1; i <= 10; i++) {
            terme2 = random.nextInt(10) + 1; // diviseur entre 2 et 10 pour éviter /1

            if (level.equals("Niveau 1")) {
                terme1 = terme2 * (random.nextInt(10) + 1); // multiple exact → reste 0
            } else {
                terme1 = random.nextInt(100) + 1;
            }

            division = new Division(terme1, terme2);
            divisions.add(division);

            Log.d("Division", level + " : terme1 = " + terme1 + ", terme2 = " + terme2 + ", reste = " + division.getReste());
        }

        return new OperationsManager<>(divisions, false);
    }
}
