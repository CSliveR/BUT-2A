package fr.iut2.androidtp.exercice5Acts;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import fr.iut2.androidtp.R;

public class ErreurActivity extends AppCompatActivity {
    private Button btnCorriger;
    private Button btnAutreTable;
    private TextView textErreur;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_erreur);
        btnCorriger = findViewById(R.id.exercice5_btnCorriger);
        btnAutreTable = findViewById(R.id.exercice5_btnAutreTable);
        textErreur = findViewById(R.id.exercice5_textErreur);

        Intent intentFromTableMultiplicationActivity = getIntent();

        int nbErreurs;
        nbErreurs = intentFromTableMultiplicationActivity.getIntExtra(TableMultiplicationActivity.NOMBRE_ERREURS,1);
        textErreur.setText(getString(R.string.exercice5_nbErreur) + " " + nbErreurs);

        int nombreTable = intentFromTableMultiplicationActivity.getIntExtra(Exercice5Activity.NOMBRE_CHOISI, 1);

        btnCorriger.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent tableMultiplicationActivityIntent = new Intent(ErreurActivity.this, TableMultiplicationActivity.class);
                tableMultiplicationActivityIntent.putExtra(Exercice5Activity.NOMBRE_CHOISI, nombreTable);
                startActivity(tableMultiplicationActivityIntent);
            }
        });

        btnAutreTable.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent exercice5ActivityIntent = new Intent(ErreurActivity.this, Exercice5Activity.class);
                startActivity(exercice5ActivityIntent);
            }
        });
    }
}