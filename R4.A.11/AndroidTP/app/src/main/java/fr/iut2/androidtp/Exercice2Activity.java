package fr.iut2.androidtp;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

public class Exercice2Activity extends AppCompatActivity{
    private RadioButton bonneReponse;
    private TextView correction;
    private Button btnValider;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_exercice2);
        // On récupére les objets de l'arbre graphique (à l'aide de leur id)
        bonneReponse = findViewById(R.id.exercice2_bonne_reponse);
        correction = findViewById(R.id.exercice2_correct);
        btnValider = findViewById(R.id.exercice2_btnValider);

        // Associe un écouteur uniquement au bouton de validation (classe anonyme)
        btnValider.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                exercice2_valider();
            }
        });
    }
    public void exercice2_valider() {
        if(bonneReponse.isChecked()){
            correction.setText("Bravo vous avez la bonne réponse");
        }else{
            correction.setText("Non ce n'est pas la bonne réponse");
        }
    }
}
