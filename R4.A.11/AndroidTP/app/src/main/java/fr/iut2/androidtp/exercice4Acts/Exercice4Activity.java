package fr.iut2.androidtp.exercice4Acts;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.appcompat.app.AppCompatActivity;

import fr.iut2.androidtp.R;

public class Exercice4Activity extends AppCompatActivity {
    private EditText prenomView;
    private Button btnValider;
    private ActivityResultLauncher<Intent> activityResultLauncher;
    public static final String MESSAGE_KEY = "message_key";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_exercice4);
        prenomView = findViewById(R.id.exercice4_prenomEditText);
        btnValider = findViewById(R.id.exercice4_btnValider);

        activityResultLauncher =
                registerForActivityResult(new ActivityResultContracts.StartActivityForResult(), new ActivityResultCallback<ActivityResult>() {
                    @Override
                    public void onActivityResult(ActivityResult result) {
                        if(result.getResultCode() == HelloActivity.RESULT_OK){
                            // Récupération de l’intent et des données associées
                            String message = result.getData().getStringExtra(Exercice4Activity.MESSAGE_KEY);
                            //ou result.getData() à la place de getIntent()
                            Toast.makeText(Exercice4Activity.this, message, Toast.LENGTH_SHORT).show();
                        }else{
                            Toast.makeText(Exercice4Activity.this, "Retour Bouton back", Toast.LENGTH_SHORT).show();
                        }
                    }
                });

        btnValider.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                String prenom = prenomView.getText().toString();
                // Création d'une intention
                Intent helloActivityIntent = new Intent(Exercice4Activity.this, HelloActivity.class);
                //Ajout de la chaîne prenom à l’intention pour transférer le prénom à la nouvelle activité
                helloActivityIntent.putExtra(HelloActivity.PRENOM_KEY, prenom);

                // Lancement de la demande de changement d'activité
                //startActivity(helloActivityIntent);
                activityResultLauncher.launch(helloActivityIntent);
            }
        });
    }
}
