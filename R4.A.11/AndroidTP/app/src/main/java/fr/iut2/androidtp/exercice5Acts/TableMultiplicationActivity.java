package fr.iut2.androidtp.exercice5Acts;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import fr.iut2.androidtp.R;
import fr.iut2.androidtp.exercice5Model.Multiplication;
import fr.iut2.androidtp.exercice5Model.TableDeMultiplication;


public class TableMultiplicationActivity extends AppCompatActivity {
    private Button btnValider;
    public static final String NOMBRE_ERREURS = "nbErreurs";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_table_multiplication);
        btnValider = findViewById(R.id.exercice5_btnValider);

        Intent intentFromExercice5Activity = getIntent();
        int nombreTable = intentFromExercice5Activity.getIntExtra(Exercice5Activity.NOMBRE_CHOISI,1);

        TableDeMultiplication tableMultiplication = new TableDeMultiplication(nombreTable, true);
        // Récupération du LinearLayout où on va ajouter les calculs
        LinearLayout linearContainer = findViewById(R.id.linear_container);

        for(Multiplication multiplication : tableMultiplication.getMultiplications()){
            LinearLayout linearTMP = (LinearLayout) getLayoutInflater().inflate(R.layout.template_calcul, null);

            TextView calcul = linearTMP.findViewById(R.id.template_calcul);
            calcul.setText(multiplication.toString());

            EditText resultat = linearTMP.findViewById(R.id.template_resultat);

            if (!resultat.getText().toString().isEmpty()) {
                multiplication.setReponseUtilisateur(Integer.parseInt(resultat.getText().toString()));
            } else {
                multiplication.setReponseUtilisateur(null);
            }
            //resultat.setText(Integer.toString(multiplication.getTerme1() * multiplication.getTerme2()));

            linearContainer.addView(linearTMP);
        }

        btnValider.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                for (int i = 0; i < linearContainer.getChildCount(); i++) {
                    View view = linearContainer.getChildAt(i);
                    EditText resultat = view.findViewById(R.id.template_resultat);
                    String resultatStr = resultat.getText().toString();

                    if(!resultatStr.isEmpty()){
                        tableMultiplication.getMultiplication(i).setReponseUtilisateur(Integer.parseInt(resultatStr));
                    }else{
                        tableMultiplication.getMultiplication(i).setReponseUtilisateur(null);
                    }
                }

                Intent endGameActivityIntent;
                if(tableMultiplication.getNombreReponsesJustes() == tableMultiplication.getNombreDeMultiplications()){
                    endGameActivityIntent = new Intent(TableMultiplicationActivity.this, FelicitationActivity.class);
                }else{
                    endGameActivityIntent = new Intent(TableMultiplicationActivity.this, ErreurActivity.class);
                }

                int nbErreurs = tableMultiplication.getNombreDeMultiplications() - tableMultiplication.getNombreReponsesJustes();
                endGameActivityIntent.putExtra(TableMultiplicationActivity.NOMBRE_ERREURS, nbErreurs);
                // Envoyer nombreTable pour l'activité ErreurActivity
                endGameActivityIntent.putExtra(Exercice5Activity.NOMBRE_CHOISI, nombreTable);
                startActivity(endGameActivityIntent);
            }
        });
    }
}