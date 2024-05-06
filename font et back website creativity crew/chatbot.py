from flask import Flask, request, jsonify
import sqlite3
from chatbase import Message

app = Flask(__name__)

# Connect to SQLite database
conn = sqlite3.connect('job_offers.db')
c = conn.cursor()

# Create a table to store job offers
c.execute('''CREATE TABLE IF NOT EXISTS job_offers
             (id INTEGER PRIMARY KEY, title TEXT, location TEXT, requirements TEXT)''')
conn.commit()

# Add some dummy data for testing
c.execute("INSERT INTO job_offers (title, location, requirements) VALUES (?, ?, ?)",
          ('Software Engineer', 'New York', 'Python, JavaScript, SQL'))
c.execute("INSERT INTO job_offers (title, location, requirements) VALUES (?, ?, ?)",
          ('Data Scientist', 'San Francisco', 'Python, R, Machine Learning'))
conn.commit()

@app.route('/chat', methods=['POST'])
def chat():
    data = request.json
    message = data['message']
    
    # Process message
    if 'job' in message.lower():
        # Query database for job offers
        c.execute("SELECT * FROM job_offers")
        offers = c.fetchall()
        
        # Format response
        response = "Here are some job offers:\n"
        for offer in offers:
            response += f"Title: {offer[1]}, Location: {offer[2]}, Requirements: {offer[3]}\n"
    else:
        response = "I'm sorry, I didn't understand your question."
    
    # Send message to Chatbase
    message = Message(api_key='YOUR_CHATBASE_API_KEY',
                      platform='YourPlatform',
                      version='1.0',
                      user_id='user123',
                      message=message,
                      intent='job_search',
                      not_handled=False)
    message.send()
    
    return jsonify({'response': response})

if __name__ == '__main__':
    app.run(debug=True)