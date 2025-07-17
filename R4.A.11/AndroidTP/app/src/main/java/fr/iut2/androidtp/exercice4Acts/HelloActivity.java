package fr.iut2.androidtp.exercice4Acts;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import fr.iut2.androidtp.MainActivity;
import fr.iut2.androidtp.R;

public class HelloActivity extends AppCompatActivity {
    private TextView salutationsTextView;
    private Button btnChangerPrenom;
    private Button btnChangerExo;
    public static final String PRENOM_KEY = "prenom_key";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_hello);

        salutationsTextView = findViewById(R.id.exercice4_salutations);
        btnChangerPrenom = findViewById(R.id.exercice4_btnChangePrenom);
        btnChangerExo = findViewById(R.id.exercice4_btnChangeExo);

        String prenom = getIntent().getStringExtra(PRENOM_KEY);
        //salutationsTextView.setText("Hello " + prenom + " !");
        salutationsTextView.setText(getResources().getString(R.string.hello_text, prenom));

        btnChangerPrenom.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                Intent exo4ActivityIntent  = new Intent(HelloActivity.this, Exercice4Activity.class);
                //startActivity(exo4ActivityIntent);

                exo4ActivityIntent.putExtra(Exercice4Activity.MESSAGE_KEY, "Nouveau prénom");
                setResult(RESULT_OK, exo4ActivityIntent);

                finish();
            }
        });

        btnChangerExo.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                // Création d'une intention
                Intent mainActivityIntent = new Intent(HelloActivity.this, MainActivity.class);
                // Permet d'éviter l'empilement des activités dans la pile
                mainActivityIntent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                // Lancement de la demande de changement d'activité
                startActivity(mainActivityIntent);
            }
        });
    }
}
