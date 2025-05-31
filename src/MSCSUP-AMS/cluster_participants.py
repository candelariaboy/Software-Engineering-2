import json
import pandas as pd
from sklearn.preprocessing import LabelEncoder
from sklearn.cluster import KMeans
from sklearn.decomposition import PCA
import matplotlib.pyplot as plt
import logging
import os

# Setup logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

def main(input_file='participant_data.json', output_file='clustering_results.json'):
    try:
        # Load JSON data
        logging.info(f"Loading data from {input_file}.")
        with open(input_file, 'r') as f:
            data = json.load(f)

        df = pd.DataFrame(data)

        # Check for empty data
        if df.empty:
            raise ValueError("No data found in the input file.")

        # Encode categorical fields
        label_encoders = {}
        for column in ['gender', 'age', 'barangay', 'sports']:
            le = LabelEncoder()
            df[f'{column}_encoded'] = le.fit_transform(df[column])
            label_encoders[column] = le

        # Features for clustering
        features = ['gender_encoded', 'age_encoded', 'barangay_encoded']
        logging.info("Performing KMeans clustering.")
        kmeans = KMeans(n_clusters=3, random_state=42, n_init='auto')
        df['cluster'] = kmeans.fit_predict(df[features])

        # Analyze interest by barangay and sport
        interest = (
            df.groupby(['barangay', 'sports'])
            .size()
            .reset_index(name='count')
            .sort_values(by='count', ascending=False)
        )

        # Perform PCA for visualization
        logging.info("Reducing dimensions for visualization.")
        pca = PCA(n_components=2)
        reduced_features = pca.fit_transform(df[features])
        df['pca_x'] = reduced_features[:, 0]
        df['pca_y'] = reduced_features[:, 1]

        # Plot clusters
        plt.figure(figsize=(8, 6))
        for cluster in df['cluster'].unique():
            cluster_data = df[df['cluster'] == cluster]
            plt.scatter(cluster_data['pca_x'], cluster_data['pca_y'], label=f'Cluster {cluster}')
        plt.title('Cluster Visualization')
        plt.xlabel('PCA Component 1')
        plt.ylabel('PCA Component 2')
        plt.legend()
        plt.grid(True)
        plt.savefig('cluster_visualization.png')
        plt.close()

        # Prepare output
        output = {
            "clusters": df[['gender', 'age', 'barangay', 'sports', 'cluster']].to_dict(orient='records'),
            "interest": interest.to_dict(orient='records')
        }

        # Write results to file
        logging.info(f"Saving results to {output_file}.")
        with open(output_file, 'w') as f:
            json.dump(output, f, indent=2)

    except Exception as e:
        logging.error(f"An error occurred: {e}")
        raise

if __name__ == "__main__":
    main()
