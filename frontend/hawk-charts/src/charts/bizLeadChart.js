import React, { useEffect, useRef, useState } from 'react';
import Chart from 'chart.js/auto';  
const BusinessLeadChart = ({ clientId }) => {
  const [leadData, setLeadData] = useState([]);
  const chartRef = useRef(null);

  useEffect(() => {
    // Fetch lead data from the PHP script by passing the client_id
    fetch(`/fetchLeads.php?client_id=${clientId}`)
      .then(response => response.json())
      .then(data => setLeadData(data))
      .catch(error => console.error('Error fetching lead data:', error));
  }, [clientId]);

  useEffect(() => {
    if (leadData.length > 0 && chartRef.current) {
      // Extract the chart data
      const labels = leadData.map(lead => lead.lead_page);
      const leadDurations = leadData.map(lead => lead.duration);

      // Get the canvas context
      const ctx = chartRef.current.getContext('2d');

      // Create chart
      const chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [
            {
              label: 'Call Duration (seconds)',
              data: leadDurations,
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });

      // Clean up chart instance on component unmount or data change
      return () => {
        chartInstance.destroy();
      };
    }
  }, [leadData]);

  if (!leadData || leadData.length === 0) return <div>Loading...</div>;

  return (
    <div>
      <h2>Lead Data for Client {clientId}</h2>
      <canvas ref={chartRef}></canvas>
    </div>
  );
};

export default BusinessLeadChart;
