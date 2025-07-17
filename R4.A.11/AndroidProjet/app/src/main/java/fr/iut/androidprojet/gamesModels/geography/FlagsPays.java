package fr.iut.androidprojet.gamesModels.geography;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

import fr.iut.androidprojet.R;

public class FlagsPays {
    private final String nom;
    private final int idFlag; // ID de l'image dans drawable
    private static int score = 0;
    private static final int TOTAL_DRAPEAUX = 10;
    public FlagsPays(String nom, int idFlag) {
        this.nom = nom;
        this.idFlag = idFlag;
    }
    public String getNom() {
        return this.nom;
    }
    public int getIdFlag() {
        return this.idFlag;
    }
    public static void incrementScore() {
        score++;
    }
    public static int getScore() {
        return score;
    }
    public static int getTotalDrapeaux() {
        return TOTAL_DRAPEAUX;
    }

    public static List<FlagsPays> initializeFlags(){
        List<FlagsPays> flags = new ArrayList<>();
        flags.add(new FlagsPays("france", R.drawable.france));
        flags.add(new FlagsPays("spain", R.drawable.espagne));
        flags.add(new FlagsPays("italy", R.drawable.italie));
        flags.add(new FlagsPays("japan", R.drawable.japon));
        flags.add(new FlagsPays("china", R.drawable.chine));
        flags.add(new FlagsPays("canada", R.drawable.canada));
        flags.add(new FlagsPays("argentina", R.drawable.argentine));
        flags.add(new FlagsPays("india", R.drawable.inde));
        flags.add(new FlagsPays("portugal", R.drawable.portugal));
        flags.add(new FlagsPays("south korea", R.drawable.coree_du_sud));
        flags.add(new FlagsPays("south africa", R.drawable.afrique_du_sud));
        flags.add(new FlagsPays("algeria", R.drawable.algerie));
        flags.add(new FlagsPays("mali", R.drawable.mali));
        flags.add(new FlagsPays("morocco", R.drawable.maroc));
        flags.add(new FlagsPays("romania", R.drawable.roumanie));
        flags.add(new FlagsPays("switzerland", R.drawable.suisse));
        flags.add(new FlagsPays("vietnam", R.drawable.vietnam));
        flags.add(new FlagsPays("turkey", R.drawable.turquie));
        flags.add(new FlagsPays("thailand", R.drawable.thailande));

        Collections.shuffle(flags);

        return flags;
    }
}
